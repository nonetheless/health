<?php

namespace App\Http\Controllers;

use App\Hrandbp;
use App\Sleepdata;
use App\Sportdata;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Unity\Util;
use DOMDocument;
use Illuminate\Support\Facades\Redirect;
use Input;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function import()
    {
        return view('health.import');
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

        $file = Input::file('file');
        $file->move('storage/uploads/sportData','1');
        $doc=new DOMDocument();
        $doc->load('storage/uploads/sportData/1');
        $dataItems=$doc->getElementsByTagName('dataItem');
        Util::sessionOpen();
        $id = $_SESSION['id'];
        foreach($dataItems as $dataItem)
        {
            $time=$dataItem->getElementsByTagName("time")->item(0)->nodeValue;
            $hr=$dataItem->getElementsByTagName("hr")->item(0)->nodeValue;
            $hbp=$dataItem->getElementsByTagName("hbp")->item(0)->nodeValue;
            $lbp=$dataItem->getElementsByTagName("lbp")->item(0)->nodeValue;
            $sporttime=$dataItem->getElementsByTagName("sporttime")->item(0)->nodeValue;
            $kind=$dataItem->getElementsByTagName("kind")->item(0)->nodeValue;
            $sleeptime=$dataItem->getElementsByTagName("sleeptime")->item(0)->nodeValue;
            $hr1 = new Hrandbp;
            $hr1->userId = $id;
            $hr1->hr = $hr;
            $hr1->hbp = $hbp;
            $hr1->lbp = $lbp;
            $hr1->time=Carbon::createFromFormat('Y-m-d',$time);
            $hr1->save();
            $spo = new Sportdata;
            $spo->userId = $id;
            $spo->time=Carbon::createFromFormat('Y-m-d',$time);
            $spo->kind = $kind;
            $spo->sporttime=$sporttime;
            $spo->save();
            $sle = new Sleepdata;
            $sle->userId = $id;
            $sle->time=Carbon::createFromFormat('Y-m-d',$time);
            $sle->sleeptime=$sleeptime;
            $sle->save();

        }
        return Redirect::to('/health/user');
    }

    public function user()
    {
        Util::sessionOpen();
        $id = $_SESSION['id'];
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
        if($time!=[]){
            $count = 0;
            $tab =[];
            $time1="[";
            $hr2 ="[";
            $hbp1 ="[";
            $lbp1 ="[";
            $sl1 ="[";
            $sp1="[";
            while($count<50){
                $temp = [$time[$count],$hr1[$count],$hbp[$count],$lbp[$count],$sl[$count],$sp[$count]];
                $tab[$count] = $temp;
                $time1 =$time1.$time[$count].',';
                $hbp1 =$hbp1.$hbp[$count].',';
                $lbp1 =$lbp1.$lbp[$count].',';
                $hr2 =$hr2.$hr1[$count].',';
                $sl1 =$sl1.$sl[$count].',';
                $sp1 =$sp1.$sp[$count].',';
                $count = $count+1;
            }
            $count = 0;
            while($count<15){
                $time1 =$time1.$time[$count].',';
                $hbp1 =$hbp1.$hbp[$count].',';
                $lbp1 =$lbp1.$lbp[$count].',';
                $hr2 =$hr2.$hr1[$count].',';
                $sl1 =$sl1.$sl[$count].',';
                $sp1 =$sp1.$sp[$count].',';
                $count = $count+1;
            }
            $time1 ="[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]";
            $hbp1 =$hbp1.$hbp[15].']';
            $lbp1 =$lbp1.$lbp[15].']';
            $hr2 =$hr2.$hr1[15].']';
            $sl1 =$sl1.$sl[15].']';
            $sp1 =$sp1.$sp[15].']';


            return view('health.main',compact('time1','hr2','hbp1','lbp1','sl1','sp1','tab'));
        }
        $time1 = "[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]";
        $hbp1 =  '[]';
        $lbp1 = '[]';
        $hr2 = '[]';
        $sl1 = '[]';
        $sp1 ='[]';
        $tab=[];
        return view('health.main', compact('time1','hr2','hbp1','lbp1','sl1','sp1','tab'));
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
