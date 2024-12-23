@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 100;">
            <div>
                        @if($item['image'] == null)
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">画像なし</text></svg>
                        @else
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="100" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" ><img src="{{ asset($item['image']) }}" width="100%" height="400"></svg>
                        @endif
                        <ul class="list-group list-group-flush">
                        <h5>商品名</h5> 
                        <li class="list-group-item">{{ $item['name'] }}</li>
                        <h5>価格</h5> 
                        <li class="list-group-item">{{ $item['price'] }}円</li>
                        <h5>商品状態</h5> 
                        <li class="list-group-item">{{ $situation_list[$item['situation']] }}</li>
                        <h5>商品説明</h5>
                        <li class="list-group-item">{{ $item['explanation'] }}</li>
                        </ul>
                </div>
                
                    <div>
                    @guest
                    @else

                        

                        @if($item['user_id'] == Auth::user()->id )
                            <form action="{{route('items.destroy', ['item' => $item['id']]) }}" method="post" >
                                @csrf
                                @method('delete')
                                <input type="submit" value="削除" class="btn btn-primary" onclick='return confirm("削除しますか？");'>
                            </form>
                            
                            <a href="{{ route('items.edit' ,['item' => $item['id']]) }}" class="btn btn-primary">出品情報変更</a>

                        @elseif($item['del_fig'] == 0 and $item['purchase_fig'] == 0)
                            @if(Auth::user()->address == null)
                            <form method="POST" action="{{ route('user_edit')}}">
                                @csrf
                                <div class="form-group row mb-0">
                                        <div class="col-md-6">
                                            <input id="item_id" type="hidden" class="form-control " name="item_id" value= "{{ $item['id'] }}" required autocomplete="name" autofocus>
                                        </div>

                                        <input type="submit" value="購入" class="btn btn-primary" onclick='return confirm("郵送先住所の設定が必要です");'>

                                    </div>
                                </form>
                            @else
                                <a href="{{ route('items.buy' ,['item' => $item['id']]) }}" class="btn btn-primary">購入画面へ</a>
                            @endif
                        @else
                        @endif
                        

                    @endguest
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
