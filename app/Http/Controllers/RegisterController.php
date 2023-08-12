<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^\S*$/u',
            'password' => 'required',
            'phone' => 'required|numeric|digits_between:10,10',
            'email' => 'required',
        ]);

        $phone = Str::startsWith($request->phone, '+84') ? $request->phone : '+84' . $request->phone;

        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return redirect('/login');
    }
}