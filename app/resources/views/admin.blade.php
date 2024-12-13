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
                            <div class='text-center'>ユーザー一覧</div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>id</th>
                                            <th scope='col'>ユーザー名</th>
                                            <th scope='col'>メールアドレス</th>
                                            <th scope='col'>アカウント状態</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ここに収入を表示する -->
                                        @foreach($users as $user)
                                        <tr>
                                            <th scope='col'>{{ $user['id'] }}</th>
                                            <th scope='col'>{{ $user['name'] }}</th>
                                            <th scope='col'>{{ $user['email'] }}</th>
                                            <th scope='col'>
                                                @if($user['use_fig'] == 0)
                                                    <a href="{{ route('use_user' ,['user' => $user['id']]) }}" class="btn btn-primary">使用可能</a>
                                                @else
                                                <a href="{{ route('use_user' ,['user' => $user['id']]) }}" class="btn btn-primary">使用停止</a> 
                                                @endif
                                            </th>
                                            
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
                            <div class='text-center'>商品一覧</div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>出品名</th>
                                            <th scope='col'>金額</th>
                                            <th scope='col'>出品者id</th>
                                            <th scope='col'>購入者</th>
                                            <th scope='col'>出品停止</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ここに収入を表示する -->
                                        @foreach($items as $item)
                                        <tr>
                                            <th scope='col'>{{ $item['name'] }}</th>
                                            <th scope='col'>{{ $item['price'] }}</th>
                                            <th scope='col'>{{ $item['user_id'] }}</th>
                                            @if($item['buyer_id'] != null)
                                            <th scope='col'>{{ $item['buyer_id'] }}</th>
                                            @else
                                            <th scope='col'>出品中</th>
                                            @endif
                                            <th scope='col'>
                                                @if($item['del_fig'] == 0)
                                                    <a href="{{ route('use_item' ,['item' => $item['id']]) }}" class="btn btn-primary">出品中</a>
                                                @else
                                                <a href="{{ route('use_item' ,['item' => $item['id']]) }}" class="btn btn-primary">出品停止</a> 
                                                @endif
                                            </th>                                        
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
