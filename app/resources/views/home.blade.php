@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class='text-center'>マイページ情報</div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>ユーザー名</th>
                                            <th scope='col'>メールアドレス</th>
                                            <th scope='col'>電話番号</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope='col'>{{ $users['name'] }}</th>
                                        <th scope='col'>{{ $users['email'] }}</th>
                                        @if($users['tel'] == null)
                                            <th scope='col'>未登録</th>
                                        @else
                                        <th scope='col'>{{ $users['tel'] }}</th>
                                        @endif
                                        </tr>
                                    </tbody>
                                </table>

                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>住所</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        @if($users['address'] == null)
                                            <th scope='col'>未登録</th>
                                        @else
                                        <th scope='col'>{{ $users['address'] }}</th>
                                        @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>

                    <div><a href="{{ route('items.create') }}" class="btn btn-primary">出品</a></div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class='text-center'>出品商品一覧</div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>出品名</th>
                                            <th scope='col'>金額</th>
                                            <th scope='col'>商品状態</th>
                                            <th scope='col'>購入状態</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ここに収入を表示する -->
                                        @foreach($listing_items as $listing_item)
                                        <tr>
                                            <th scope='col'>{{ $listing_item['name'] }}</th>
                                            <th scope='col'>{{ $listing_item['price'] }}</th>
                                            <th scope='col'>{{ $listing_item['situation'] }}</th>
                                            @if($listing_item['purchase_fig'] == 0)
                                                <th scope='col'>出品中</th>
                                            @else
                                                <th scope='col'>売却済み</th>
                                            @endif
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class='text-center'>購入商品一覧</div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>出品名</th>
                                            <th scope='col'>金額</th>
                                            <th scope='col'>商品状態</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ここに収入を表示する -->
                                        @foreach($buy_items as $buy_item)
                                        <tr>
                                            <th scope='col'>{{ $buy_item['name'] }}</th>
                                            <th scope='col'>{{ $buy_item['price'] }}</th>
                                            <th scope='col'>{{ $buy_item['situation'] }}</th>
                                            <th scope='col'> <a  class="btn btn-primary" href="{{ route('items.show' ,['item' => $buy_item['id']]) }}">詳細</a></th>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class='text-center'>売却済商品一覧</div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>出品名</th>
                                            <th scope='col'>金額</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        @foreach($listing_items as $listing_item)
                                        @if($listing_item['purchase_fig'] == 1)
                                        <tr>
                                            <th scope='col'>{{ $listing_item['name'] }}</th>
                                            <th scope='col'>{{ $listing_item['price'] }}</th>
                                            <th scope='col'> <a  class="btn btn-primary" href="{{ route('items.show' ,['item' => $listing_item['id']]) }}">詳細</a></th>
                                        </tr>
                                        @endif
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
