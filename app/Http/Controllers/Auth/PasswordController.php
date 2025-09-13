<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Rules\NotConsecutive;
use Auth;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {   
        try {
             $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed', new NotConsecutive],
            ]);           
        } catch (ValidationException $e) {

            if($request->ajax()){

                return response()->json([
                    'errors' => $e->errors()

                ]);
            }
            throw $e;
        }


        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        if($request->ajax()){

        Auth::guard('web')->logout();

        session()->forget('user_session_id'); // Forget user session

            return response()->json([
                'redirect' => route('login'),
                'message' => 'Password updated, please login!'             

        ]); 

        }


        
    }
}
