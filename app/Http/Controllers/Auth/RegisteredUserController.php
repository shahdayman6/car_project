<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'name' => 'required|string|max:4096',
        'email' => 'required|string|lowercase|email|max:255|unique:users,email',
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('profile_images', 'public');
    }

    $validated['password'] = Hash::make($validated['password']);

    $user = User::create($validated);

    event(new Registered($user));
    Auth::login($user);

    return redirect()->intended('/');
}

}
