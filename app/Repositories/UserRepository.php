<?php

namespace App\Repositories;

use App\Models\EmploymentLevel;
use App\Models\EmploymentType;
use App\Models\UserRole;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserRepository
{
    public function create($data, $user_role_id)
    {
        $user = UserRole::findOrFail($user_role_id)->users()->create([
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);

        if ($user_role_id == UserRole::CANDIDATE) {
            return $this->createCandidate($user, $data);
        } else if ($user_role_id == UserRole::RECRUITER) {
            return $this->createRecruiter($user, $data)->user;
        }

        return $user;
    }

    public function createCandidate($user, $data)
    {
        $candidate = $user->candidate();

        if (!$candidate = $candidate->create([
            'hash_name' => md5($user->id),
            'full_name' => $data->full_name,
            'email' => $user->email,
        ])) {
            return false;
        }

        if (!$candidate->candidate_setting()->create([])) {
            return false;
        }

        $candidate->employment_levels()->sync(EmploymentLevel::all());
        $candidate->employment_types()->sync(EmploymentType::all());

        return $candidate;
    }

    public function createRecruiter($user, $data)
    {
        return $user->recruiter()->create([
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
        ]);
    }

    public function updateEmail($data, $model = false)
    {
        return $this->getModel($model)->update([
            'email' => $data->email,
        ]);
    }

    public function updatePassword($data, $model = false)
    {
        return Hash::check($data->current_password, $this->getModel($model)->password) ? $this->getModel($model)->update([
            'password' => bcrypt($data->new_password),
        ]) : false;
    }

    public function getModel($model = false)
    {
        if (!$model) {
            return request()->user();
        }
        return $model = is_object($model) ? $model : User::findOrFail($model);
    }
}