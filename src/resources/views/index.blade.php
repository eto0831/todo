@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__alert">
    @if(session('message'))
    {{-- ↑コントローラ内の->('message', '内容')のキーを指定しセッションから取り出している --}}
    <div class="todo__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="todo__alert--danger">
        <ul>
            @foreach($errors->all() as $error)
            {{-- ↑発生した全てのエラーメッセージを配列として取得する --}}
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="todo__content">
    <div class="section__title">
        <h2>新規作成</h2>
    </div>
    <form class="create-form" action="/todos" method="post">
        @csrf
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="content" value="{{ old('content') }}">
            <select class="create-form__item-select" name="category_id">
                {{-- ↑nameの中身はcategory_idカラム名と一致 --}}
                @foreach($sorts as $kind)
                <option value="{{ $kind['id'] }}">{{ $kind['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>
    <div class="section__title">
        <h2>Todo検索</h2>
    </div>
    <form class="search-form" action="/todos/search" method="get">
        @csrf
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
            <select class="search-form__item-select" name="category_id">
                @foreach($sorts as $kind)
                <option value="{{ $kind['id'] }}">{{ $kind['name'] }}</option>
                {{-- ↑optionにvalueでidを入れないと検索が機能しない --}}
                @endforeach
            </select>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
        </div>
    </form>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">
                    <span class="todo-table__header-span">Todo</span>
                    <span class="todo-table__header-span">カテゴリ</span>
                </th>
            </tr>
            @foreach($lists as $task)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form action="todos/update" class="update-form" method="post">
                        @method('PATCH')
                        {{-- HTMLのフォームには、直接指定することができん。HTMLのfromタグにはPOSTを指定し、@methodディレクティブでPATCHを指定 --}}
                        @csrf
                        <div class="update-form__item">
                            <input class="update-form__item-input" type="text" name="content" value= "{{ $task['content'] }}">
                            <input type="hidden" name="id" value="{{ $task['id'] }}">
                            {{-- 二行目のhiddenのinputで、繰り返される$todoからvalue="{{ $todo['id'] }}" でTODOを識別するためのIDが設定されている --}}
                        </div>
                        <div class="update-form__item">
                            <p class="update-form__item-p">{{ $task['category'] ['name'] }}</p>
                            {{-- ↑'category'はTodoモデルのcategoryメソッド、nameはCategory の name 属性 --}}
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form action="todos/delete" class="delete-form" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__button">
                            <input type="hidden" name="id" value="{{ $task['id'] }}">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection