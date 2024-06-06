<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username = "id21996215_cuongtq203";
    $password = "Cuong2k3@";
    $dbname = "id21996215_equipease";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    $email = $_POST['email'];
        if (empty($email)) {
            header("Location: forgotpassword.php");
            $error_message = "Không được để email trống";
    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
        }else{
            $sql = "SELECT * FROM Users WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
        // Chuyển hướng đến trang xác nhận OTP
                header("Location: resetpassword.php");
            } else {
                $error_message = "Email chưa được đăng ký tài khoản.";
    }
}
    $conn->close();
    if (isset($_SESSION['reset_password_success']) && $_SESSION['reset_password_success']) {
    // Đặt số lần đăng nhập sai về 0
    $_SESSION['login_attempts'] = 0;
    // Chuyển hướng đến trang chủ
    header("Location: dashboard.php");
    exit();
}
}
?>

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
        .error-message {
            color: red;
            font-size: 1em; /* Thay đổi kích thước font về đơn vị em */
            position: fixed; /* Cung cấp vị trí cố định */
            top: 39%; /* Vị trí từ phía trên của màn hình */
            left: 67%; /* Vị trí từ phía trái của màn hình */
            transform: translate(-40%, -65%); /* Dịch chuyển error message về trung tâm của màn hình */
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
            <h2>Forgot the password</h2>
                <form action="resetpassword.php" method="post" style="text-align: center;">
                <div class="input-container">
                    <input type="text" id="email" name="email" placeholder="Enter your email">
                </div>
                <div id="error-message-container"></div>
                    <script>
                        // Hàm hiển thị thông báo lỗi
                        function displayErrorMessage(message) {
                            var errorMessageContainer = document.getElementById("error-message-container");
                            errorMessageContainer.innerHTML = '<div class="error-message">' + message + '</div>';
                        }

                        // Hàm xóa thông báo lỗi
                        function clearErrorMessage() {
                            var errorMessageContainer = document.getElementById("error-message-container");
                            errorMessageContainer.innerHTML = '';
                        }

                        <?php
                        // Kiểm tra nếu có thông báo lỗi từ PHP, thì hiển thị thông báo lỗi bằng JavaScript
                        if (!empty($error_message)) {
                            echo 'displayErrorMessage("' . $error_message . '");';
                        } else {
                            echo 'clearErrorMessage();';
                        }
                        ?>
                    </script>
                <button type="submit" name="send">Send</button>
                </form>
                <div/>
        </div>
    </div>
</div>
</body>
</html>