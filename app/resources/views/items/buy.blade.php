@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 100 ;">

            <div class="card-header">購入確認</div>

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

                <div class="card-body">
                    <div class="card-header">
                            <div class='text-center'>配送先</div>
                        </div>
                            <div class="card-body">
                                
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>郵便番号</th>
                                            <th scope='col'>住所</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                            <th scope='col'>{{ $user['postcode'] }}</th>
                                            <th scope='col'>{{ $user['address'] }}</th>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                <div>

                    <a href="{{ route('items.buy_confirm' ,['item' => $item['id']]) }}" class="btn btn-primary">購入</a>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
