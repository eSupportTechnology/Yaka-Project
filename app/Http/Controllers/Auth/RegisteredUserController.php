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
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('newFrontend.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


     public function store(Request $request): RedirectResponse
     {
         try {
             // Add custom validation rules
             $request->validate([
                 'first_name' => ['required', 'string', 'max:255'],
                 'last_name' => ['required', 'string', 'max:255'],
                 'phone_number' => ['required', 'string', 'max:15', 'unique:users,phone_number'],
                 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                 'password' => ['required', 'confirmed', Rules\Password::defaults()],
             ]);

             // Log validation success
             Log::info('Validation passed for user registration', [
                 'first_name' => $request->first_name,
                 'last_name' => $request->last_name,
                 'email' => $request->email,
                 'phone_number' => $request->phone_number,
             ]);

             // Create the user with custom fields
             $user = User::create([
                 'first_name' => $request->first_name,
                 'last_name' => $request->last_name,
                 'phone_number' => $request->phone_number,
                 'email' => $request->email,
                 'password' => Hash::make($request->password),
                 'roles' => 'user',
             ]);

             Log::info('User successfully created', ['user_id' => $user->id]);

            //  event(new Registered($user));

             Auth::login($user);

             // Redirect to the correct login route
             return redirect()->route('verify-mobile')->with('success', 'Registration completed. Enter your Mobile number again for verify mobile');

         } catch (\Exception $e) {
             // Log the error details
             Log::error('Error during user registration', [
                 'error_message' => $e->getMessage(),
                 'trace' => $e->getTraceAsString(),
             ]);

             // Optionally, you can return a redirect or view with error messages
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
     }


}
