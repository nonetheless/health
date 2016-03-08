<?php

namespace App\Http\Controllers;

use App\Game;
use App\Suser;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Unity\Util;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $games = Game::all();

        return view('game.allGame',compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('game.newGame');
    }

    public function join($id)
    {
        //
        $game = Game::findOrFail($id);
        Util::sessionOpen();
        $game->susers()->attach($_SESSION['id']);

        return Redirect::to('/game/'.$id);
    }

    public function out($id)
    {
        //
        $game = Game::findOrFail($id);
        Util::sessionOpen();
        $game->susers()->detach($_SESSION['id']);

        return Redirect::to('/game/'.$id);
    }

    public function change($id)
    {
        //
        $game = Game::findOrFail($id);

        return view('game.changeGame',compact('game'));

    }

    public function del($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return Redirect::to('/game/all');
    }


    public function upd(Requests\StoreGameRequest $request)
    {
        //
        $game = Game::find($request->get('id'));
        $game->update($request->except('id'));

        return Redirect::to('/game/'.$request->get('id'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreGameRequest $request)
    {
        //
        $input = $request->all();
        $input['info'] = mb_substr($request->get('content'),0,30);
        Util::sessionOpen();
        $input['writerId']=$_SESSION['id'];
        $id = $_SESSION['id'];
        $game = Game::create($input);
        $game->susers()->attach($id);

        return Redirect::to('/game/all');
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

        $game = Game::findOrFail($id);
        $user = Suser::findOrFail($game->writerId);
        Util::sessionOpen();
        $loder =$_SESSION['id'];
        $test = 0;
        if($game->susers){
            foreach($game->susers as $user1){
                if ($user1->id==$loder){
                    $test = 2;
                    break;
                }
            }
        }
        if($loder==$game->writerId){
            $test=1;
        }
        return view('game.oneGame',compact('game','user','test'));
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
