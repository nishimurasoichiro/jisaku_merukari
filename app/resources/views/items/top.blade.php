@extends('layouts.app')

@section('content')
<div class="container">
    
        <div>
            <form action="{{ route('items.index') }}" method="post" >
                @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">ワード検索</label>
                <input type="text" class="form-control" id="word" aria-describedby="emailHelp" name = 'ward' placeholder="検索ワードを入れてください">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">価格</label>
                <input type="text" class="form-control" id="price_min" name = 'price_min' placeholder="価格下限">
            </div>
            <p>~</p>
            <div class="form-group">
                <input type="text" class="form-control" id="price_max" name = 'price_max' placeholder="価格上限">
            </div>
            <button type="submit" class="btn btn-primary">検索</button>
            
            </form>
        </div>


    <div class="row justify-content-center">
        <div class="col-md-8">
        
    <script>
      $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/ajaxlike',  //routeの記述
            type: 'POST', //受け取り方法の記述（GETもある）
            data: {
                'item_id': likesItemId //コントローラーに渡すパラメーター
            },
            })

        // Ajaxリクエストが成功した場合
        .done(function (data) {
        //lovedクラスを追加
            $this.toggleClass('loved'); 

        //.likesCountの次の要素のhtmlを「data.itemLikesCount」の値に書き換える
            $this.next('.likesCount').html(data.itemLikesCount); 

        })
        // Ajaxリクエストが失敗した場合
        .fail(function (data, xhr, err) {
        //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
        //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
            console.log('エラー');
            console.log(err);
            console.log(xhr);
        });
    
    return false;
    </script>
        <div class="card">
            @foreach($items as $item)
                <div class="card">
                    <div class="card-footer" style="width: 18rem;">
                        @if($item['image'] == null)
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">画像なし</text></svg>
                        @else
                        <img src="{{ asset($item['image']) }}" width="100%" height="100%">
                        @endif
                        <div class="card-body">
                            <h4 class="item-title">{{ $item['name'] }}</h5>
                            <h5 class="card-title">{{ $item['price'] }}円</h5>
                            <a  class="btn btn-primary" href="{{ route('items.show' ,['item' => $item['id']]) }}">詳細</a>
                            
                            @if($likes_model->like_exist(Auth::user()->id,$item->id))
                            <p class="favorite-marke">
                            <a class="js-like-toggle loved" href="" data-itemid="{{ $item->id }}">いいね済み</a>
                            <span class="likesCount">{{$item->likes_count}}</span>
                            </p>
                            @else
                            <p class="favorite-marke">
                            <a class="js-like-toggle" href="" data-itemid="{{ $item->id }}">いいねじゃないよ</i></a>
                            <span class="likesCount">{{$item->likes_count}}</span>
                            </p>
                            @endif
                            
 
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </div>

</div>
@endsection
