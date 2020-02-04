<?php

namespace App\Http\Controllers;
use App\Item;
use App\Review;
use App\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Item $item){
        $review = Review::where('item_id', $item->id)->where('user_id', Auth::id())->first();
        $review_count = Review::where('item_id', $item->id)->count();
        $total_value = round(Review::where('item_id', $item->id)->avg('value'));
        $total_value = $this->convert($total_value);
        return view('review/index', ['item' => $item, 'review' => $review, 'total_value' => $total_value, 'review_count' => $review_count]);
    }

    public function store(Request $request, Item $item){
        //既にレビューをしていたら名前、内容、評価を更新。初めてなら新規追加。
        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'item_id' => $request->post('item_id'),
            ],
            [
                'content' => $request->post('content'),
                'name' => $request->post('name'),
                'value' => $request->post('value'),
            ]   
        );
        $is_my_review = Review::where([
            ['item_id', $item->id],
            ['user_id', Auth::id()]
        ])->exists();
        $review_count = Review::where('item_id', $item->id)->count();
        $total_value = round(Review::where('item_id', $item->id)->avg('value'));
        $total_value = $this->convert($total_value);
        $reviews = Review::where('item_id', $item->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('item/show', ['item' => $item, 'flash_message' => 'レビューを投稿しました', 'reviews' => $reviews,
            'review_count' => $review_count, 'my_review' => $is_my_review, 'total_value' => $total_value]);
    }

    public function convert($total_value){
        switch($total_value){
            case 1:
                $total_value = '★';
                break;
            case 2:
                $total_value = '★★';
                break;
            case 3:
                $total_value = '★★★';
                break;
            case 4:
                $total_value = '★★★★';
                break;
            case 5:
                $total_value = '★★★★★';
                break;
            default:
                $total_value = '';
                break;
        }
        return $total_value;
    }

}
