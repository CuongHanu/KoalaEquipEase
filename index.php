<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:700|Noto+Serif+Display:700&display=swap" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            height: 100%;
            font-family: 'Roboto Slab', serif;
        }
        .background {
            background-image: url("https://lh3.googleusercontent.com/-r1lMZCA_al8/Zfj3_q5-6KI/AAAAAAAAAQk/vL4ivlyn_i8w5PbOArsUsSRA9aQjMkPaACNcBGAsYHQ/s0/%25E1%25BA%25A2nh%2Bn%25E1%25BB%2581n%2Bsau.jpg");
            height: 100%;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            max-width: 1000px;
            width: 100%;
            display: flex;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            border-radius: 10px;
            overflow: hidden;
        }
        .left-side {
            width: 50%;
            background: linear-gradient(to bottom, #05296D, #1E90FF); /* Gradient color to light blue */
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .right-side {
            width: 50%;
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Noto Serif Display', serif;
        }
        img {
            width: 150px;
        }
        .input-container {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #05296D;
            border-radius: 25px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            border: none;
            outline: none;
            border-radius: 25px;
            font-size: 1.2em;
        }
        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: #888;
        }
        input[type="text"]:focus::placeholder, input[type="password"]:focus::placeholder {
            color: transparent;
        }
        a {
            position: relative;
            text-decoration: none;
            color: #05296D;
            font-size: 1.2em;
        }
        a:before {
            content: "\1F512";
            position: absolute;
            left: -1.5em;
            color: black;
        }
        button {
            background-color: #05296D;
            color: white;
            padding: 10px 20px;
            margin-top: 10px;
            border: none;
            cursor: pointer;
            border-radius: 25px;
            font-size: 1.2em;
        }
        p {
            text-align: center;
            font-size: 2em;
        }
        h2 {
            font-size: 2em;
        }
    </style>
</head>
<body>
<div class="background">
    <div class="login-container">
        <div class="left-side">
            <img src="https://lh3.googleusercontent.com/-zGv4rCSXJg0/Zfj4Tdg4jHI/AAAAAAAAAQs/GrhpBwvxbLYtKmGv2SRxGL-GAr1D_tzHgCNcBGAsYHQ/h120/Logo%2BKoalahouse.png" alt='Logo'>
            <p>EquipEase<br>Koala Education Centre</p>
        </div>
        <div class="right-side">
            <h2>Log in</h2>
            <form action="login.php" method="post" style="text-align: center;">
                <div class="input-container">
                    <input type="text" id="username" name="username" placeholder="Username">
                </div>
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Password">
                </div>
                <a href="forgotpassword.php">Forgot the password</a>
                <br>
                <button type="submit" name="login">Login</button>
            </form>
            </form>
        </div>
    </div>
</div>
</body>
</html>
