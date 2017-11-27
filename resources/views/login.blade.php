<html>
    <head>
    </head>
    <body>
        <form method="POST" action="/login">
            {{ csrf_field() }}
            <input type="text" name="name" required>
            <input type="password" name="password" required>
            <button type="submit">ログイン</button>
        </form>
    </body>
</html>