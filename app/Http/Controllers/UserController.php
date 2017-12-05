<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class UserController extends Controller{

    public function postSignUp(Request $request){

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required|max:120',
            'pass' => 'required|min:4'
        ]);

        $email = $request['email'];
        $first_name = $request['name'];
        $pass = bcrypt($request['pass']);

        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $pass;

        $user->save();
        Auth::login($user);
        return redirect()->route('dashboard');

    }
    public function postSignIn(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'pass' => 'required'
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['pass']])) {

            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function getAccount(){

        return view('account', ['user'=>Auth::user()]);
    }

    public function updateAccount(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:120'
        ]);
        $user = Auth::user();
        $old_name = $user->first_name;
        $user->first_name = $request['first_name'];
        $user->update();
        $file = $request->file('image');
        $filename = $request['first_name'] . '-' . $user->id . '.jpg';
        $old_filename = $old_name . '-' . $user->id . '.jpg';
        $update = false;
        if (Storage::disk('local')->has($old_filename)) {
            $old_file = Storage::disk('local')->get($old_filename);
            Storage::disk('local')->put($filename, $old_file);
            $update = true;
        }
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        if ($update && $old_filename !== $filename) {
            Storage::delete($old_filename);
        }
        return redirect()->route('account');

    }

    public function getUserImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

}
