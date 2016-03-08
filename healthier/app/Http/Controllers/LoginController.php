<?php

namespace App\Http\Controllers;

use App\Luser;
use App\Suser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Unity\Util;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function admin()
    {
        return view('admin');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id = $_POST['email'];
        $password = $_POST['password'];
        $user = Suser::where('email','=',$id,'and','password','=',$password)->count();
        if($user){
            return Redirect::to('/login');
        }
        $user1 = new Suser;
        $user1->email = $id;
        $user1->password= $password;
        $user1->name = $id;
        $user1->location = '无';
        $user1->about = '无';
        $user1->sign = '无';
        $user1->birthday = Carbon::now();

        $user1->save();
        $userid = $user1->id;
        Util::sessionOpen();
        Util::setCurrentUserId($userid);
        return Redirect::to('/setting/'.$userid);
    }

    public function login(Request $request)
    {
        $id = $_POST['email'];
        $password = $_POST['password'];
        $user = Suser::where('email','=',$id,'and','password','=',$password)->first();

        if(!$user){

            return Redirect::to('/register');
        }
        if($user->password!=$password){
            return 'false';
        }

        $userid = $user->id;
        Util::sessionOpen();
        Util::setCurrentUserId($userid);
        return Redirect::to('/setting/'.$userid);

    }

    public function adminLogin(Request $request)
    {
        $id = $_POST['email'];
        $password = $_POST['password'];
        $user = Luser::where('email','=',$id,'and','password','=',$password)->first();
        if(!$user){

            return '无权限';
        }
        if($user->password!=$password){
            return '密码错误';
        }

        $userid = $user->id;
        Util::sessionOpen();
        Util::setCurrentAdminId($userid);
        if($user->kind=='admin'){
            return Redirect::to('/admin');
        }
        return Redirect::to('/advice');


    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}