<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('frontend.auth.register-login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {   

        try {
            $request->authenticate();

            session(['user_session_id' => session()->getId()]);

        } catch (ValidationException $e) {

            if($request->ajax()){

                return response()->json(['errors' => $e->errors()], 422);
            }
            
        }

        if ($request->ajax()) {
            
            return response()->json([

                'redirect' => url('/')
            ]);
        }

        return redirect()->intended(route('dashboard', absolute: false));


        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        session()->forget('user_session_id'); // Forget user session

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
