<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>iReklamo</title>
    </head>
    <body>

        <header>
            <h1>iReklamo</h1>
            <nav>
                <a href="/login">Login</a>
                <a href="/signup">Signup</a>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
    </body>
    </html>