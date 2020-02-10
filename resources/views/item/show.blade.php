@extends('layouts.app')

@section('content')
    @isset($flash_message)
        <div class="alert alert-success">
            {{$flash_message}}
        </div>
    @endisset
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                        <p class="card-text">
                            <strong><商品価格></strong><br>
                            ¥{{ number_format($item->amount) }}(税込価格)
                        </P>

                        <p class="card-text">
                            <strong><商品説明></strong><br>
                            {{$item->content}}
                        <p>

                        @if(count($reviews) > 0)
                            <h5 class="card-title">レビュー</h5>
                            @foreach($reviews as $review)
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{$review->content}}</P>
                                        <div class="text-right text-muted">
                                            <span>{{$review->name}}さん</span>
                                            <span>{{$review->created_at}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center mt-2">
                            {{ $reviews->links() }}
                            </div>
                        @else
                            <em style="color:blue;">まだレビューはありません</em>
                        @endif

                        <div class="mt-4">
                            @if($my_review)
                                <a class="btn btn-primary" href="/review/{{$item->id}}" role="button">レビューを編集</a>
                            @else
                                <a class="btn btn-primary" href="/review/{{$item->id}}" role="button">レビューを投稿</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
