<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('frontend.auth.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {   
        try {
            $request->user()->fill($request->validated());

        } catch (ValidationException $e) {

            if($request->ajax()){

                return response()->json([

                    'errors' => $e->errors()
                ]);
            }
            
        }
        

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $old_imamge_path = $request->user()->image;

            if(file_exists($old_imamge_path)){
                unlink($old_imamge_path);
            }
            // Store the image in storage/app/public/profile_images (adjust path as you want)
            $path = $image->store('profile_images', 'public');

            // Save the path or filename in the user model
            $request->user()->image = 'public/storage/'. $path;
        }        

        $request->user()->save();

        if($request->ajax()){

            return response()->json([

                'redirect' => url('/profile')
            ]);            
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
