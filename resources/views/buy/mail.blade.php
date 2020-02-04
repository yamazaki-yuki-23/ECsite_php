<div>
    これは{{config('app.name', 'Laravel')}}のテストメールです。
</div>
<div>
    この度はご購入ありがとうございます。
</div>
<br>
購入商品は下記のとおりです
---------------------
@foreach ($cartitems['cartitems'] as $cartitem)
    <div>
        {{ $cartitem->name }}
        <ul>
            <li>{{ $cartitem->amount }}円</li>
            <li>{{ $cartitem->quantity }}個</li>
        </ul>
    </div>
@endforeach
---------------------
<div>
    合計金額は{{number_format($cartitems['subtotal'])}}円です<br>
    入金が確認され次第、発送致します。
</div>