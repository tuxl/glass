<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function loginPage(Request $request){
        return \view('login', ['err'=>'']);
    }

    public function loginSbumit(Request $request){
        $user = $request->input('username', '');
        $password = $request->input('password', '');
        $account = Account::where('name', $user)->first();
        if ($account == null){
            return \view('login', ['err'=>'用户名不存在']);
        }
        if (!password_verify($password, $account->password))
        {
            return \view('login', ['err'=>'密码错误']);
        }
        session([
            'name' => $user,
            'id' => $account->id,
            'login' => 1,
        ]);
        return redirect('/admin');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
