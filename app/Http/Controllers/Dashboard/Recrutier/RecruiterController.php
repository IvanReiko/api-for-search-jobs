<?php

namespace App\Http\Controllers\Dashboard\Recrutier;

use App\Http\Requests\Recruiter\RecruiterTeamRequest;
use App\Http\Requests\User\ProfilePasswordRequest;
use App\Http\Requests\User\ProfileRequest;
use App\Repositories\Web\UserRepository;
use App\Repositories\Web\RecruiterRepository;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{

    protected $user;
    protected $recruiter;

    public function __construct(UserRepository $model, RecruiterRepository $recruiter)
    {
        $this->user = $model;
        $this->recruiter = $recruiter;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(\Auth::user()->id)->first();
//        return view('recruiter.index', ['user' => $user->recruiter]);
    }

    public function viewUpdate()
    {
        $user = User::findOrFail(\Auth::user()->id);
        return view('recruiter.profile.edit', ['user' => $user->recruiter]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\ProfileRequest
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(ProfileRequest $request)
    {
        $this->user->updateProfile($request);
        return redirect(route('recruiter.edit'));
    }

    //public function updatePassword(ProfilePasswordRequest $request)
    public function updatePassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'current_password' => 'required|string|min:6|max:100',
            'new_password' => 'required|string|min:6|max:100|confirmed',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('new_password', 'Something is wrong with this field!');
            $validator->errors()->add('new_password_confirmation', 'Password doesn\'t match confirmation!');
            return redirect()->back()->withErrors($validator);
        }else{
            $response = $this->user->updatePassword($request);
            return redirect()->back()
                ->with('status', $response ? 'success' : 'danger')
                ->with('message', !$response ? 'Error' : 'Success');
        }

    }

    public function updateLanguage(\Illuminate\Http\Request $request)
    {
        $response = $this->recruiter->getModel()->update([
            'language_id' => $request->language_id
        ]);
        return redirect()->back()
            ->with('status', $response ? 'success' : 'danger')
            ->with('message', !$response ? 'Error' : 'Success');
    }

    public function team()
    {
        $recruiters = $this->recruiter->getAll()->load(['team_recruiters', 'user'])->where('user_id', \Auth::user()->id);

        return view('recruiter.list', compact('recruiters', 'image'));
    }

    public function teamCreate()
    {
        return view('recruiter.create');
    }

    public function teamStore(RecruiterTeamRequest $request)
    {
        $this->recruiter->teamCreate($request);
        return redirect(route('recruiter.team.index'));
    }

    public function wishlistAdd($id)
    {
        $wishlist = $this->recruiter->wishlistAdd($id);
        return redirect()->route('candidate.show', $id);
    }


}
