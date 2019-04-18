<?php
/**
 * Created by PhpStorm.
 * User: longta
 * Date: 2019/03/14
 * Time: 16:50
 */

namespace App\Services\Domain;


use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserService
{
    public function getAllUsers(){
        $users = User::all();
        return $users;
    }

    public function UpdatePassWord($pass, $id){
        $user = User::find($id);
        $user->password = $pass;
        $user->save();
    }
}