<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Models\UserRole;
use App\Http\Requests\Api\Auth\ChangeEmailRequest;
use App\Http\Requests\Api\Auth\ChangePasswordRequest;

class AuthController extends ApiController
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function signIn(Request $request)
    {
        return self::getAccessToken($request);
    }

    public function signUp(Request $request)
    {
        if ($errors = $this->validationUserCreate($request)) {
            return $errors;
        }

        $this->users->create($request, UserRole::CANDIDATE);

        return self::getAccessToken($request);
    }

    protected function validationUserCreate($request)
    {
        $validator = validator($request->only('email', 'full_name', 'password'), [
            'full_name' => 'required|max:100',
            'email'     => 'required|string|email|max:100|unique:users|unique:candidates',
            'password'  => 'required|string|min:6|max:100',
        ]);

        if ($validator->fails()) {
            return $this->respondValidationError($validator);
        }

        return null;
    }

    protected function getAccessToken($request)
    {
        $client = Client::where('password_client', 1)->first();

        $request->request->add([
            'grant_type'    => 'password',
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'username'      => $request->email,
            'password'      => $request->password,
        ]);

        $tokenRequest = Request::create(
            'oauth/token',
            'POST'
        );

        return \Route::dispatch($tokenRequest);
    }

    public function changeEmail(ChangeEmailRequest $request)
    {
        $this->users->updateEmail($request);
        return $this->respondCreated('Email changed successfully');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->password = $request->new_password;
        $this->users->updatePassword($request);
        return $this->respondCreated('Password changed successfully');
    }

    public function logout(Request $request)
    {
        $request->user()->oauth_acess_token()->delete();
        return $this->respondSuccess('Logout successfully');
    }
}
