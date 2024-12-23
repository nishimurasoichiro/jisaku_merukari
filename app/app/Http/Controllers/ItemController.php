<?php

use App\Models\Items;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Likes;
use App\Models\Users;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $userid = Auth::id();
        $items = new Items;
        $like_model = new Likes;
        
        
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
                        ->withCount('likes')
                        ->get();

                        return view('items.top',[
                            'items' => $items,
                            'likes_model' => $like_model,
                        ]);
        }else{
            $items = $items ->where('user_id','!=',$userid)
                        ->where('del_fig','0')
                        ->where('purchase_fig','0')
                        ->where('price','<=',$price_max)
                        ->where('price','>=',$price_min)
                        ->withCount('likes')
                        ->get();
                        
                        return view('items.top',[
                            'items' => $items,
                            'likes_model' => $like_model,
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
        $situation_list = ['','悪い','少し悪い','普通','良い','非常に良い'];

        return view('items.show_item',[
            'item' => $item,
            'situation_list' =>$situation_list,
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

        return redirect('home'); 
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

        return redirect('home'); 
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
        $users = new Users;
        $user = $users->find(Auth::id());

        $items = $items->where('id',$id)->first();
        $situation_list = ['','悪い','少し悪い','普通','良い','非常に良い'];

        return view('items.buy',[
            'item' => $items,
            'user' => $user,
            'situation_list' =>$situation_list,
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

    public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $item_id = $request->item_id;
        $like = new Likes;
        $item = Items::findOrFail($item_id);

        $like_flg = "";
        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id,$item_id)) {
            //likesテーブルのレコードを削除
            $like = Likes::where('item_id', $item_id)->where('user_id', $id)->delete();
            $like_flg = 0;

        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Likes;
            $like->item_id = $item_id;
            $like->user_id = $id;
            $like->save();

            $like_flg = 1;
        }

       
        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $itemLikesCount = $item->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'itemLikesCount' => $itemLikesCount,
            'like_flg' =>$like_flg,
        ];
        //下記の記述でajaxに引数の値を返す

        return response()->json($json);
    }

}
