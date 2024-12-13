@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 100;">
                <div>
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" ><img src="{{ asset($item['image']) }}" width="100%" height="180"></svg>
                    
                    
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $item['name'] }}</li>
                        <li class="list-group-item">{{ $item['price'] }}円</li>
                        <h5>商品状態</h4> 
                        <li class="list-group-item">{{ $item['situation'] }}</li>
                        <h5>商品説明</h4>
                        <li class="list-group-item">{{ $item['explanation'] }}</li>
                        </ul>
                </div>

                
                    <div>
                    @guest
                    @else
                        <!-- @if($item['user_id'] == 1 ) -->
                            <form action="{{route('items.destroy', ['item' => $item['id']]) }}" method="post" >
                                @csrf
                                @method('delete')
                                <input type="submit" value="削除" class="btn btn-primary" onclick='return confirm("削除しますか？");'>
                            </form>
                            
                            <a href="{{ route('items.edit' ,['item' => $item['id']]) }}" class="btn btn-primary">出品情報変更</a>
                        <!-- @endif -->
                        <a href="{{ route('items.buy' ,['item' => $item['id']]) }}" class="btn btn-primary">購入</a>

                    @endguest
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
