@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">出品情報変更</div>

                <div class="card-body">
                <form action="{{ route('items.update',['item' => $item['id']]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">商品名</label>
                        <input type="name" class="form-control" id="name" name='name'  placeholder="商品名" value = "{{$item['name']}}">
                    </div>

                    <div class="form-group">
                        <label for="image">画像</label>
                        <input type="image" class="form-control" name='price' placeholder="画像" value="{{$item['image']}}">
                    </div>

                    <div class="form-group">
                        <label for="price">価格</label>
                        <input type="price" class="form-control" name='price' placeholder="価格" value = "{{$item['price']}}">
                    </div>

                    <div class="form-group">
                        <label for="explanation">商品説明</label>
                        <textarea class="form-control" id="explanation" name='explanation' rows="3" >{{$item['explanation']}}</textarea>
                    </div>

                    <label for="situation">商品説明</label> 
                    <select name='situation'>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                    </select>
                    
                    <button type="submit" class="btn btn-primary">登録</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
