<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id){
        $user = User::query()->findOrFail($id);

        return view('user.show',compact('user'));
    }
}
