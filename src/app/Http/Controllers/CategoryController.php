<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index() {
        $sorts = Category::all();
        return view('category', compact('sorts'));
    }

    public function store(CategoryRequest $request ) {
        $kind = $request->only(['name']);
        Category::create($kind);
        return redirect('/categories')->with('message', 'カテゴリを作成しました');
    }

    public function update(CategoryRequest $request) {
        $kind = $request->only(['name']);
        Category::find($request->id)->update($kind);
        return redirect('/categories')->with('message', 'カテゴリを更新しました');
    }

    public function delete(Request $request) {
        Category::find($request->id)->delete();
        return redirect('/categories')->with('message', 'カテゴリを削除しました');
    }
}
