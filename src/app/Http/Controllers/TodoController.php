<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Models\Category;

class TodoController extends Controller
{
    public function index()
    {
        $lists = Todo::with('category')->get();
        //↑'category'はTodoモデルのcategoryメソッド
        $sorts = Category::all();
        return view('index', compact('lists', 'sorts'));
        //↑compact関数で、todosというキーでヴューに渡す
    }

    public function store(TodoRequest $request){
        $task = $request->only(['category_id', 'content']);
        //↑＄request内contentのみ抽出、category_idはselectのname属性と一致
        Todo::create($task);

        return redirect('/')->with('message', 'Todoを作成しました' );

    }

    public function update(TodoRequest $request)
    {
        $task = $request->only(['content']);
        //↑contentのみ抽出
        Todo::find($request->id)->update($task);
        //モデルで更新対象のidを探させる→$todoに値をupdate()

        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }


    public function search(Request $request){
        //Todoモデル内のscopeCategorySearchとscopeKeywordSearchから来ている
        $lists = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $sorts = Category::all();
        //↑検索を行った後の値を$todosとしてindex.blade.phpに送り出し、表示を行ってる

        return view('index', compact('lists', 'sorts'));

    }
}
