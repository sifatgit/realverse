<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\NewsLetter;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.admin.login');
    }

    public function login(Request $request)
    {

        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);            
        } catch (ValidationException $e) {

            if($request->ajax()){
                return response()->json([
                    'errors' => $e->errors()
                ], 422);                
            }            
        }
       

        // Step 2: Check if admin exists with the given email

    $errors = [];

    // Check if admin with given email exists
    $admin = \App\Models\Admin::where('email', $request->email)->first();

    if (! $admin) {
        $errors['email'] = ['This email is not registered.'];
    } else {
        // Email exists, now check password
        if (! \Hash::check($request->password, $admin->password)) {
            $errors['password'] = ['The password is incorrect.'];
        }
    }

    if (!empty($errors)) {
        if ($request->ajax()) {
            return response()->json([
                'errors' => $errors
            ], 422);
        }
        return back()->withErrors($errors)->withInput();
    }


        if (Auth::guard('admin')->attempt($credentials)) {


        if ($request->ajax()) {
            
            return response()->json([

                'redirect' => url('/admin/dashboard')
            ]);
            session(['admin_session_id' => session()->getId()]);            
        }
            
        }

            if($request->ajax()){
                return response()->json([
                    'errors' => $e->errors()
                ], 422);                
            } 

    }

    public function dashboard()
    {
        return view('backend.admin.index');
    }

    public function newsletters(){

        $newsletters = Newsletter::all();
        return view('backend.admin.pages.newsletters',compact('newsletters'));
    } 

    public function messages(){

        $messages = Message::all();
        return view('backend.admin.pages.messages',compact('messages'));
    }

    public function changestatus(Request $request,$id){

        $message = Message::findOrFail($id);

        $message->status = $request->status;

        $message->save();

        return response()->json();
    }

    public function delete($id){

        $message = Message::findOrFail($id);

        $message->delete();

        return back()->with('success','Message removed successfully!');
    }

     public function deleteall(){

            $message = Message::all();

            $message->each->delete();

            return back()->with('success','Entire Message cleared successfully!');
        }

    public function newsletterdelete($id){

        $newsletter = NewsLetter::findOrFail($id);

        $newsletter->delete();

        return back()->with('success','Newsletter removed successfully!');
    }

    public function newsletterdeleteall(){

            $newsletters = NewsLetter::all();

            $newsletters->each->delete();

            return back()->with('success','Entire Newsletter Cleared successfully!');
        }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // Clear any custom session variables
        $request->session()->forget('admin_session_id');
        $request->session()->forget('admin_token_verified');

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect()->route('admin.login', ['admin_token' => env('ADMIN_ACCESS_TOKEN')]);
    }

}
