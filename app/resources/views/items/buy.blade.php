@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 100 ;">

            <div class="card-header">購入確認</div>

                <div>
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" ><img src="{{ asset($item['image']) }}" width="100%" height="180"></svg>
                
                        <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>商品名</th>
                                            <th scope='col'>価格</th>
                                            <th scope='col'>商品状態</th>
                                            <th scope='col'>商品説明</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope='col'>{{ $item['name'] }}</th>
                                            <th scope='col'>{{ $item['price'] }}円</th>
                                            <th scope='col'>{{ $item['situation'] }}</th>
                                            <th scope='col'>{{ $item['explanation'] }}</th>
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
