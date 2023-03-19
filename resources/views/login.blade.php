
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>S-Kepuharjo</title>
</head>

<body>
    <div class="alert alert-warning" role="alert">
    </div>

    <div class="container">
        <form action="{{ route('postlogin') }}" method="POST"  class="login-email">
            {{ csrf_field() }}
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="field" placeholder="User Id" name="name" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                {{--  <a  class="btn" href="/dashboard">login</a>  --}}
                <button type="submit" class="btn">Login</button>
            </div>
            <!-- <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p> -->
        </form>
    </div>
</body>

</html>
