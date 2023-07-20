<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.pages.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect('/edit-profile')->with('status', 'profile-updated');
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

        return Redirect::to('/admin/all-users');
    }

    /**
     * Validate user's email
     */
    public function validateEmail(Request $request) {
        $user = User::where('email', $request->email)->first();
        if($user)
            return view('auth.reset-password', compact('user'));
        
        else
            return back()->with('status', 'We could not find an account associated with this email address!');
    }

    /**
     * Store user's updated password
     */
    public function storeNewPassword(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        if($request->password != $request->password_confirmation){
            return redirect('/reset-password')->with('status', 'Password does not match!');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/loginForm')->with('message', 'Password has been reset successfully!');
    }
}
