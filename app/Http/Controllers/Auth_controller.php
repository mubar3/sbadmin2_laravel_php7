<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Auth_controller extends Controller
{

    public function login_page()
    {   
        if(!Auth::check()){
            return view('admin.login');
        }else{
            return view('dashboard.index');
        }
    }
    public function login(Request $data)
    {

        if(Auth::attempt(['email' => $data->email, 'password' => $data->pass])){
            // Auth::user()->createToken('pandawa')->accessToken;
            return redirect('/dashboard');
        }
        return redirect('/');
    }
    
    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function register()
    {
        $data=[
            'name' => 'mubar',
            'email' => 'mubar@mubar',
            'password' => bcrypt('asd')
        ];
        $user = User::create($data);
        return $data;
    }
    
    public function aksi_edit_user(Request $data)
    {
        $user = User::where('id',Auth::user()->id)->update([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->pass)
        ]);
        return redirect('/dashboard');
    }

    public function edit_user()
    {
        return view('admin.edit');
    }

    public function logout() {
        try {
            session()->flush();
            // Auth::user()->token()->revoke();
            // Auth::user()->token()->delete();
            return redirect('/');
        } catch (Exception $e) {
            return redirect('/');
        }
    }
}
