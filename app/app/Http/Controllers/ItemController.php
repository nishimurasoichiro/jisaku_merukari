<?php

use App\Models\Items;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Items;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userid = Auth::id();
        $items = new Items;

        if($request->price_min != null){
            $price_min = $request->price_min;
        }else{
            $price_min = 0;
        }

        if($request->price_max != null){
            $price_max = $request->price_max;
        }else{
            $price_max = 9999999999999;
        }
        
        $word = $request->word;

        if($word != null){
            $items = $items ->where('user_id','!=',$userid)
                        ->where('del_fig','0')
                        ->where('purchase_fig','0')
                        ->where('price','<=',$price_max)
                        ->where('price','>=',$price_min)
                        ->where('name','LIKE',"%{$word}%")
                        ->get();

                        return view('items.top',[
                            'items' => $items,
                        ]);
        }else{
            $items = $items ->where('user_id','!=',$userid)
                        ->where('del_fig','0')
                        ->where('purchase_fig','0')
                        
                        ->get();

                        

                        return view('items.top',[
                            'items' => $items,
                        ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view(
            'items.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dir = 'sample';
        // アップロードされたファイル名を取得
        $file = $request->file('image');


        $file_name = $file->getClientOriginalName();

        $request->file('image')->storeAs('public/' . $dir, $file_name);

        $items = new Items;

        $items->name = $request->name;
        $items->image = 'storage/' . $dir . '/' . $file_name;
        $items->price = $request->price;
        $items->explanation = $request->explanation;
        $items->situation = $request->situation;


        Auth::user()->items()->save($items);

        return redirect('home'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = new Items;

        $item = $item->where('id',$id)->first();

        return view('items.show_item',[
            'item' => $item,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = new Items;
        $item = $item->where('id',$id)->first();

        return view('items.edit_item',[
            'item' => $item,
            ]);
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
        $items = new Items;
        $items = $items->find($id);

        $columns = ['name','image','price','explanation','situation'];

        foreach($columns as $column){
            $items->$column = $request->$column;
        }

        $items->save();

        return redirect('items'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = new Items;

        $items = $items->where('id',$id)->first();

        $items->delete();

        return redirect('items'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buy($id)
    {
        $items = new Items;

        $items = $items->where('id',$id)->first();

        return view('items.buy',[
            'item' => $items,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buy_confirm($id)
    {
        $items = new Items;
        $items = $items->find($id);
        
        $items->buyer_id = Auth::id();
        $items->purchase_fig = 1;
        $items->buy_at = Carbon::now();


        $items->save();

        return redirect('items'); 
    }

    
}
