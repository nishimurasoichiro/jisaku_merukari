@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー情報変更</div>

                <div class="card-body">                
                    <form method="POST" action="{{route('update_user', ['user_id' => $user['id']]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">ユーザー名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="{{ $user['name']}}" required autocomplete="name" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="{{ $user['email']}}" required autocomplete="email">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">電話番号</label>

                            <div class="col-md-6">
                                <input id="tel" type="tel" class="form-control " name="tel" value="{{ $user['tel']}}" required autocomplete="tel">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode" class="col-md-4 col-form-label text-md-right">郵便番号</label>

                            <div class="col-md-6">
                                <input id="postcode" type="postcode" class="form-control" name="postcode" value="{{ $user['postcode']}}" required autocomplete="postcode">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">住所</label>

                            <div class="col-md-6">
                                <input id="address" type="address" class="form-control"  name="address" value="{{ $user['address']}}" required autocomplete="address">
                            </div>
                        </div>

                        <div class="col-md-6">
                            @if($item_id == null)
                                <input id="item_id" type="hidden" class="form-control " name="item_id" value=null required autocomplete="item_id" autofocus>
                            @else
                            <input id="item_id" type="hidden" class="form-control " name="item_id" value="{{ $item_id}}" required autocomplete="item_id" autofocus>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    変更
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
