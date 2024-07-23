<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
            <a href="/" class="header__logo">Todo</a>
            <nav>
                <ul class="header-nav">
                    <li class="header-nav__item">
                        <a href="/categories" class="header-nav__link">カテゴリ一覧</a>
                    </li>
                </ul>
            </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>