<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageController extends Controller
{
    public function index()
    {
        $users= User::all();
        return view('manage', ['users' => $users]);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('manage')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('manage')->with('error', 'User not found.');
        }
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'new-password' => 'nullable',
        'phone' =>'required',
        'address'=>'required',
        'email'=>'required|email',
    ]);

    $user = User::find($id);

    if ($user) {
        $user->name = $validatedData['name'];

        if ($validatedData['new-password']) {
            $user->password = Hash::make($validatedData['new-password']);
        }

        $user->email = $validatedData['email'];
        $user->address = $validatedData['address'];
        $user->phone = $validatedData['phone'];
        $user->save();

        // You might want to return a redirect or response here instead of JSON
        return redirect()->back()->with('success', 'User updated successfully');
    } else {
        return redirect()->back()->with('error', 'User not found');
    }
}

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        if (empty($searchTerm)) {
            $users = User::whereIn('role', 'user','admin')->get();
        } else {
            $users = User::where('role', 'user')->where('name', 'like', '%' . $searchTerm . '%')->get();
        }

        return view('manage')->with('users', $users);
    }
} 