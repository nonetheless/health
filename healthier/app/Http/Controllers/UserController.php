<?php

namespace App\Http\Controllers;

use App\Advice;
use App\Luser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Suser;
use App\Hrandbp;
use App\Sleepdata;
use App\Sportdata;
use App\Http\Controllers\Unity\Util;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Input;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    public function set($id)
    {

        $user = Suser::findOrFail($id);

        return view('user.setting',compact('user'));
    }



    public function updateInfo()
    {
        Util::sessionOpen();
        $userId = $_SESSION['id'];
        $user1 = Suser::findOrFail($userId);
        $date1 = explode('-',$_POST['birthday']);
        $date = Carbon::create($date1[0],$date1[1],$date1[2]);
        $user1->update(['name'=>$_POST['name'],'email'=>$_POST['email'], 'location'=>$_POST['location']
            ,'birthday'=>$date,'about'=>$_POST['about'],'sign'=>$_POST['sign']]);
        $user = $user1;
        return view('user.setting',compact('user'));

    }

    public function updateImg(){
        Util::sessionOpen();
        $user = $_SESSION['id'];
        $file = Input::file('image');
        if($file==null){
            return 'null';
        }
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }

        $destinationPath = 'image/';
        $filename = 'user'.$user.'.jpg';
        $file->move($destinationPath, $filename);
        return Redirect::to('/setting/'.$user);
    }




    public function updatePassword()
    {
        Util::sessionOpen();
        $user = $_SESSION['id'];
        $user1 = Suser::findOrFail($user);
        $password = $user1->password;
        if($password==$_POST['oldPassword']){
            $user1->update(['password'=>$_POST['surePassword']]);
            $user2 = Suser::findOrFail($user);
            return '修改密码成功';

        }
        return '密码不正确';


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        Util::sessionOpen();
        $userId = $_SESSION['id'];
        $test = 0;
        if($id == $userId){
            $test=1;
        }
        $user = Suser::findOrFail($id);
        $games = $user->games;
        $advices =Advice::where('userId','=',$id)->get();
        $hr = Hrandbp::where('userId','=',$id)->latest()->get();
        $sport = Sportdata::where('userId','=',$id)->latest()->get();
        $sleep = Sleepdata::where('userId','=',$id)->latest()->get();
        $time=[];
        $hr1 = [];
        $hbp = [];
        $lbp = [];
        $sp = [];
        $sl = [];
        $count = 0;
        foreach($hr as $x){
            $time[$count] = $x->time;
            $hr1[$count] = $x->hr;
            $hbp[$count] = $x->hbp;
            $lbp[$count] = $x->lbp;
            $count = $count+1;
            if ($count>=50){
                break;
            }
        }
        $count = 0;
        foreach($sleep as $x){
            $sl[$count] = $x->sleeptime;
            $count = $count+1;
            if ($count>=50){
                break;
            }
        }
        $count = 0;
        foreach($sport as $x){
            $sp[$count] = $x->sporttime;
            $count = $count+1;
            if ($count>=50){
                break;
            }
        }
        if($time!=[]) {
            $count = 0;
            $tab = [];
            $time1 = "[";
            $hr2 = "[";
            $hbp1 = "[";
            $lbp1 = "[";
            $sl1 = "[";
            $sp1 = "[";
            while ($count < 50) {
                $temp = [$time[$count], $hr1[$count], $hbp[$count], $lbp[$count], $sl[$count], $sp[$count]];
                $tab[$count] = $temp;
                $time1 = $time1 . $time[$count] . ',';
                $hbp1 = $hbp1 . $hbp[$count] . ',';
                $lbp1 = $lbp1 . $lbp[$count] . ',';
                $hr2 = $hr2 . $hr1[$count] . ',';
                $sl1 = $sl1 . $sl[$count] . ',';
                $sp1 = $sp1 . $sp[$count] . ',';
                $count = $count + 1;
            }
            $count = 0;
            while ($count < 15) {
                $time1 = $time1 . $time[$count] . ',';
                $hbp1 = $hbp1 . $hbp[$count] . ',';
                $lbp1 = $lbp1 . $lbp[$count] . ',';
                $hr2 = $hr2 . $hr1[$count] . ',';
                $sl1 = $sl1 . $sl[$count] . ',';
                $sp1 = $sp1 . $sp[$count] . ',';
                $count = $count + 1;
            }
            $time1 = "[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]";
            $hbp1 = $hbp1 . $hbp[15] . ']';
            $lbp1 = $lbp1 . $lbp[15] . ']';
            $hr2 = $hr2 . $hr1[15] . ']';
            $sl1 = $sl1 . $sl[15] . ']';
            $sp1 = $sp1 . $sp[15] . ']';
            return view('user.main', compact('user', 'games', 'test', 'advices', 'time1', 'hr2', 'hbp1', 'lbp1', 'sl1', 'sp1'));
        }
        $time1 = "[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]";
        $hbp1 =  '[]';
        $lbp1 = '[]';
        $hr2 = '[]';
        $sl1 = '[]';
        $sp1 ='[]';
        return view('user.main', compact('user', 'games', 'test', 'advices', 'time1', 'hr2', 'hbp1', 'lbp1', 'sl1', 'sp1'));

    }

    public function adminAdd(){
        $admin = Luser::all();

        return view('user.manage',compact('admin'));
    }

    public function adminPass(Requests\AdminPassword $request){
        $user=Luser::findOrFail($request->get('id'));
        if($request->get('oldpassword')==$user->password){
            $user->password = $request->get('password');
            $user->save();
            return Redirect::to('/admin/change');
        }

        return '密码错误';

    }

    public function adminInfo(Requests\AdminInfo $request){
        $user=Luser::findOrFail($request->get('id'));
        $user->update($request->except('id'));

        return Redirect::to('/admin/change');
    }

    public function adminChange(){
        Util::sessionOpen();
        $admId = $_SESSION['admin'];
        $admin = Luser::findOrFail($admId);

        return view('user.adminSetting',compact('admin'));
    }

    public function adminDel($id){
        $admin = Luser::findOrFail($id);
        $admin->delete();

        return Redirect::to('/admin');


    }

    public function adminStore(Requests\StoreAdminRequest $request){
        $input = $request->all();
        $input['name'] = $request->get('email');
        Luser::create($input);

        return Redirect::to('/admin');
    }

    public function turn(){
        Util::sessionOpen();
        $userId = $_SESSION['admin'];
        $user = Luser::findOrFail($userId);
        if($user->kind=='admin'){
            return Redirect::to('/admin');
        }

        return Redirect::to('/advice');
    }

    public function advice(){
        $users = Suser::all();

        return view('user.advice',compact('users'));
    }

    public function adviceOne($id){
        Util::sessionOpen();

        $hr = Hrandbp::where('userId','=',$id)->latest()->get();
        $sport = Sportdata::where('userId','=',$id)->latest()->get();
        $sleep = Sleepdata::where('userId','=',$id)->latest()->get();
        $time=[];
        $hr1 = [];
        $hbp = [];
        $lbp = [];
        $sp = [];
        $sl = [];
        $count = 0;
        foreach($hr as $x){
            $time[$count] = $x->time;
            $hr1[$count] = $x->hr;
            $hbp[$count] = $x->hbp;
            $lbp[$count] = $x->lbp;
            $count = $count+1;
            if ($count>=50){
                break;
            }
        }
        $count = 0;
        foreach($sleep as $x){
            $sl[$count] = $x->sleeptime;
            $count = $count+1;
            if ($count>=50){
                break;
            }
        }
        $count = 0;
        foreach($sport as $x){
            $sp[$count] = $x->sporttime;
            $count = $count+1;
            if ($count>=50){
                break;
            }
        }
        if($time!=[]) {
            $count = 0;
            $tab = [];
            $time1 = "[";
            $hr2 = "[";
            $hbp1 = "[";
            $lbp1 = "[";
            $sl1 = "[";
            $sp1 = "[";
            while ($count < 50) {
                $temp = [$time[$count], $hr1[$count], $hbp[$count], $lbp[$count], $sl[$count], $sp[$count]];
                $tab[$count] = $temp;
                $time1 = $time1 . $time[$count] . ',';
                $hbp1 = $hbp1 . $hbp[$count] . ',';
                $lbp1 = $lbp1 . $lbp[$count] . ',';
                $hr2 = $hr2 . $hr1[$count] . ',';
                $sl1 = $sl1 . $sl[$count] . ',';
                $sp1 = $sp1 . $sp[$count] . ',';
                $count = $count + 1;
            }
            $count = 0;
            while ($count < 15) {
                $time1 = $time1 . $time[$count] . ',';
                $hbp1 = $hbp1 . $hbp[$count] . ',';
                $lbp1 = $lbp1 . $lbp[$count] . ',';
                $hr2 = $hr2 . $hr1[$count] . ',';
                $sl1 = $sl1 . $sl[$count] . ',';
                $sp1 = $sp1 . $sp[$count] . ',';
                $count = $count + 1;
            }
            $time1 = "[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]";
            $hbp1 = $hbp1 . $hbp[15] . ']';
            $lbp1 = $lbp1 . $lbp[15] . ']';
            $hr2 = $hr2 . $hr1[15] . ']';
            $sl1 = $sl1 . $sl[15] . ']';
            $sp1 = $sp1 . $sp[15] . ']';


            return view('user.adviceOne', compact('time1', 'hr2', 'hbp1', 'lbp1', 'sl1', 'sp1', 'tab','id'));
        }
        $time1 = "[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]";
        $hbp1 =  '[]';
        $lbp1 = '[]';
        $hr2 = '[]';
        $sl1 = '[]';
        $sp1 ='[]';
        $tab=[];
        return view('user.adviceOne', compact('time1', 'hr2', 'hbp1', 'lbp1', 'sl1', 'sp1', 'tab','id'));
    }

    public function adviceInputOne(Requests\AdviceInput $request){
        $input = $request->all();
        Util::sessionOpen();
        $adminId = $_SESSION['admin'];
        $input['adminId'] = $adminId;
        $input['time'] = Carbon::now();

        Advice::create($input);

        return '操作成功';
    }
    public function adviceInputAll(Requests\AdviceInput $request){
        $input = $request->all();
        Util::sessionOpen();
        $adminId = $_SESSION['admin'];
        $input['adminId'] = $adminId;
        $input['time'] = Carbon::now();
        $users = Suser::all();
        foreach($users as $user){
            $input['userId'] = $user->id;
            Advice::create($input);
        }

        return '操作成功';
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
