<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                    $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng Nhập</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <style>
        p, header, img{
            margin: 0;
            padding: 0;
            border: 0;
            text-decoration: none;
        }

        body {
            background: linear-gradient(0deg,rgba(0,0,0,0.1),rgba(0,0,0,0.8)) ,url(./../assets/image/signinup.jpg) no-repeat center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            -ms-background-size: cover;
            background-attachment: fixed;
            font-family: 'Dosis', sans-serif;
        }

        header {
            font-size: 2.8em;
            text-transform: capitalize;
            color: white;
            letter-spacing: 3px;
            word-spacing: 3px;
            margin: 1em 1vw 1.5em;
            text-align: center;
            font-family: 'Dosis', sans-serif;
            display: block;
            color: darkorange;;
        }

        p {
            margin: 1em 1vw 1.5em;
            text-align: center;
            font-size: 1.2em;
        }

        a {
            color:azure;
        }

        label, input, #login, #email, #password, div{
            text-align: center;
            margin: 0 auto;
        }

        input {
            background-color: white;
        }
        
        button {
            background-color: darkorange;
        }

        button:hover{
            background-color: orange;
        }
    </style>
</head>
<body>
    <header>
        <a href="../index.html">ALO CỨU HỘ 14</a>
    </header>
    <p>Hãy điền tên đăng nhập và mật khẩu tại đây.</p>
    
    <?php if ($is_invalid): ?>
        <em>Tài khoản hoặc mật khẩu lỗi!</em>
    <?php endif; ?>
    
    <form method="post">
        
        <label for="email">Email</label>
        <input type="email" name="email" id="email"
        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Mật Khẩu</label>
        <input type="password" name="password" id="password">
        <br>
        <button>Đăng Nhập</button>
    </form>
    <p>Chưa có tài khoản? <a href="signup.html">Đăng ký tại đây.</a></p>
    
</body>
</html>







