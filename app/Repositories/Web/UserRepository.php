<?php

namespace App\Repositories\Web;

use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use App\Repositories\UserRepository as BaseUserRepository;

class UserRepository extends BaseWebRepository
{

    public function create($data, $user_role_id)
    {
        return (new BaseUserRepository)->create($data, $user_role_id);
    }

    public function updateEmail($data, $model = false)
    {
        return (new BaseUserRepository)->updateEmail($data, $model);
    }

    public function updatePassword($data, $model = false)
    {
        return (new BaseUserRepository)->updatePassword($data, $model);
    }

    public function updateProfile($data, $model = false)
    {
        if($data->hasFile('photo_url')) {
            $image = $data->file('photo_url');
            $this->fileDelete($this->getModel()->recruiter->photo_url);
            $photo_url = $image->hashName();
            $image = Image::make($image)->fit(96, 96)->encode();
            Storage::disk('public')->put($photo_url, (string)$image);
        }
        return $this->getModel($model)->recruiter()->update([
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'position' => $data->position,
            'photo_url' => ($data->hasFile('photo_url') ? asset('storage/' . $photo_url) : $this->getModel()->recruiter->photo_url)
        ]);
    }

    public function getModel($model = false)
    {
        return (new BaseUserRepository)->getModel($model);
    }
}