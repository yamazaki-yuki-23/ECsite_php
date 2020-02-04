<?php

namespace App\Http\Controllers;

use App\Item;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('keyword')){
            $validatedData = $request->validate([
                'keyword' => 'required',
            ]);
            $items = Item::where('name', 'like', '%'.$request->get('keyword').'%')->paginate(15);
            return view('item/index', ['items' => $items, 'keyword' => $request->keyword]);
        }else{
            $keyword = null;
            $items = Item::paginate(15);
            return view('item/index', ['items' => $items, 'keyword' => $keyword]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //レビューテーブルに存在チェック
        $is_my_review = Review::where([
            ['item_id', $item->id],
            ['user_id', Auth::id()]
        ])->exists();
        $reviews = Review::where('item_id', $item->id)->orderBy('created_at', 'desc')->paginate(5);
        $review_count = Review::where('item_id', $item->id)->count();
        $total_value = round(Review::where('item_id', $item->id)->avg('value'));
        $total_value = $this->convert($total_value);
        return view('item/show', ['item' => $item, 'reviews' => $reviews, 'my_review' => $is_my_review,
            'total_value' => $total_value, 'review_count' => $review_count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
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
