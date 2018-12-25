<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
//  注册
    public function create()
    {
        //显示用户注册表单
        return view('users.create');
    }

    //个人中心
    public function show(User $user)
    {
        //数据与视图绑定
        return view('users.show', compact('user'));
    }

    //用户注册数据验证
    //Request获取用户输入
    public function store(Request $request)
    {
        $this->validate($request, [
            //required 是否为空
            'name' => 'required|max:50',
            //email:邮箱格式验证
            //unique:users：数据唯一性验证
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success','欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }
}
