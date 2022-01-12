<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\KYC;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\UploadTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    use UploadTrait;
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'username' => ['required', 'unique:users'],
            'state' => ['required'],
            'zip' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'country' => ['required'],

            'photo' => ['required'],
            'front' => ['required'],
            'back' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),


            'username' => $request->username,
            'state' => $request->state,
            'zip' => $request->zip,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        // 
        // kyc 

        $photo = $request->file('photo');
        $folder = '/uploads/images/' . $user->id . '/';
        $photoPath = $folder . time() . '_photo_' . $photo->getFilename() . '.' . $photo->getClientOriginalExtension();
        $this->uploadOne($photo, $folder, 'public-uploads', time() . '_photo_' . $photo->getFilename());

        $front = $request->file('front');
        $frontPath = $folder . time() . '_front_' .  $front->getFilename() . '.' . $front->getClientOriginalExtension();
        $this->uploadOne($front, $folder, 'public-uploads', time() . '_front_' .  $front->getFilename());

        $back = $request->file('back');
        $backPath = $folder . time() . '_back_' .  $back->getFilename() . '.' . $back->getClientOriginalExtension();
        $this->uploadOne($back, $folder, 'public-uploads', time() . '_back_' .  $back->getFilename());


        KYC::create([
            'photo' => $photoPath,
            'front' => $frontPath,
            'back' => $backPath,
            'user_id' => $user->id
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}