<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index');
    }
    
    public function edit()
    {
        return view('pages.profile.edit');
    }
    
    public function update(ProfileUpdateRequest $request)
    {
        $data = $request->validated();
        $data['updated_at'] = now();

        if($data['password']){
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if($request->hasFile('avatar')){
            if($request->user()->avatar){
                Storage::delete($request->user()->avatar);
            }
            
            $data['avatar'] = $request->file('avatar')->store('avatars');
        }

        User::where('id', $request->user()->id)->update($data);

        return redirect()->back()->with('success', 'Your profile has been updated!');
    }
}
