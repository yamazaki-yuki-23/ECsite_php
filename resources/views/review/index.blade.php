@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @auth
                    <div class="card">
                        <div class="card-header">
                            <a href="/item/{{$item->id}}">{{$item->name}}</a>
                            @if($total_value)
                                <div class="row pl-3">
                                    <div class="star-rating">
                                        <div class="star-rating-front">{{$total_value}}</div>
                                        <div class="star-rating-back">{{$total_value}}</div>
                                    </div>
                                    <small class="pt-1 pl-1">{{$review_count}}件の評価</small>
                                </div>
                            @endempty
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/review/{{$item->id}}">
                                @csrf
                                <p class="card-text">
                                    <strong><商品価格></strong><br>
                                    ¥{{ number_format($item->amount) }}(税抜価格)
                                </P>

                                <p class="card-text">
                                    <strong><商品説明></strong><br>
                                    {{$item->content}}
                                <p>

                                <div class="form-group">
                                    <label for="text1">名前</label>
                                    @isset($review->name)
                                        <input class="form-control" type="text" id="text1" name="name" value="{{$review->name}}" required>
                                    @else
                                        <input class="form-control" type="text" id="text1" name="name" required>
                                    @endisset
                                </div>
                                <div class="form-group">
                                    <label for="content">内容</label>
                                    @isset($review->content)
                                        <textarea class="form-control" id="content" rows="5"　name="content" required>{{$review->content}}</textarea>
                                    @else
                                        <textarea class="form-control" id="content" rows="5"　name="content" required></textarea>
                                    @endisset
                                </div>

                                <label for="value">評価</label><br>
                                <div class="form-check form-check-inline pr-2">
                                    <input class="form-check-input" type="radio" name="value" id="inlineRadio1" value="1" checked required>
                                    <label class="form-check-label" for="inlineRadio1">1</label>
                                </div>
                                <div class="form-check form-check-inline pr-2">
                                    <input class="form-check-input" type="radio" name="value" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">2</label>
                                </div>
                                <div class="form-check form-check-inline pr-2">
                                    <input class="form-check-input" type="radio" name="value" id="inlineRadio3" value="3">
                                    <label class="form-check-label" for="inlineRadio3">3</label>
                                </div>
                                <div class="form-check form-check-inline pr-2">
                                    <input class="form-check-input" type="radio" name="value" id="inlineRadio2" value="4">
                                    <label class="form-check-label" for="inlineRadio2">4</label>
                                </div>
                                <div class="form-check form-check-inline pr-2">
                                    <input class="form-check-input" type="radio" name="value" id="inlineRadio3" value="5">
                                    <label class="form-check-label" for="inlineRadio3">5</label>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary btn-lg">投稿</button>
                                </div>
                                <input type="hidden" name="item_id" value="{{$item->id}}">
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Eメール') }}</label>

                                    <div class="col-md-7">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('パスワード') }}</label>

                                    <div class="col-md-7">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7 offset-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-7 offset-md-3">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('ログイン') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('パスワードを忘れた場合') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            
                            <p class="login-border mt-5 col-md-7 offset-md-3">登録がまだの方はこちら</p>
                            <a href="{{ route('register') }}" class="btn btn-primary  col-md-7 offset-md-3">登録</a>
                        </div>
                    </div>    
                @endauth
            </div>
        </div>
    </div>
@endsection