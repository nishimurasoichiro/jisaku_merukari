<?php

use App\Models\Items;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Users;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = new Items;
        $users = new Users;

        if( Auth::id() == 1){
            $items = $items -> all();
            $users = $users -> all();

            return view('admin',[
                'items' => $items,
                'users' => $users,
            ]);
        }else{
            $listing_items = Auth::user()->items()->get();
            $buy_items = $items = $items->where('buyer_id', Auth::id())->get();
            $users = $users = $users->where('id', Auth::id())->first();
            
            return view('home',[
                'listing_items' => $listing_items,
                'buy_items' => $buy_items,
                'users' => $users,
                
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function use_user($id)
    {
        $users = new Users;
        $users = $users->find($id);
        
        if($users['use_fig'] == 0){
            
            $users->use_fig = 1;
        }else{
            $users->use_fig = 0;
        }

        $users->save();
        return redirect('home'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function use_item($id)
    {
        $items = new Items;
        $items = $items->find($id);
        
        if($items['del_fig'] == 0){
            
            $items->del_fig = 1;
        }else{
            $items->del_fig = 0;
        }

        $items->save();
        return redirect('home'); 
    }
}