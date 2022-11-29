<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function is_admin(){

//        $userRole = User::select('roles.name')->join('roles', 'role_id', 'roles.id')->where('users.id','=',Auth::id())->get()->first();
        if(Auth::user()){
            $userRole = Role::where('id','=',Auth::user()->role_id)->get()->first();
            return $userRole->name === 'admin';
        }
        else{
            return false;
        }



    }
}
