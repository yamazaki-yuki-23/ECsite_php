@extends('layouts.app')

@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{session('flash_message')}}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-left">
            @if(count($items) > 0)
                @foreach($items as $item)
                    <div class="col-md-4 mb-2">
                        <div class="card">
                            <div class="card-header ellipsis">
                                <a href="/item/{{$item->id}}">{{$item->name}}</a>
                            </div>
                            <div class="card-body">
                                ¥{{ number_format($item->amount) }}
                            </div>
                            @auth
                                <form method="POST" action="cartitem" class="form-inline m-1">
                                    {{csrf_field()}}
                                    <select name="quantity" class="form-control col-md-2 mr-1">
                                        <option selected>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-primary col-md-6">カートに入れる</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                @endforeach
            @else
                <div class="ml-3">
                    <h4>{{$keyword}}の検索に一致する商品はありませんでした。</h4>
                    <p>スペルの確認を試み、もう一度入力ください<br>
                        ショッピングを続けるには<a href="{{('/')}}">ECsiteトップ</a>へどうぞ。
                    </p>
                </div>
            @endif
        </div>
        @if($keyword == NULL)
            <div class="row justify-content-center">
                {{$items->links()}}
            </div>
        @else
            <div class="row justify-content-center">
                {{$items->appends(['keyword' => Request::get('keyword')])->links() }}
            </div>
        @endif
    </div>
@endsection
