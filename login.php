<?php
session_start();

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "id21996215_cuongtq203";
$password = "Cuong2k3@";
$dbname = "id21996215_equipease";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}
$max_login_attempts = 5;
// Xử lý thông tin đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Kiểm tra xem người dùng đã nhập đủ thông tin hay chưa
    if (empty($username) || empty($password)) {
    $error_message = "Không được để tên hoặc mật khẩu trống";
} else {
    // Kiểm tra tên đăng nhập và mật khẩu trong cơ sở dữ liệu
    $sql = "SELECT * FROM Users WHERE user_name='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Tên đăng nhập và mật khẩu đúng
        $_SESSION['logged_in'] = true;
        // Đặt số lần đăng nhập sai về 0
        $_SESSION['username'] = $username; // Lưu tên đăng nhập vào phiên làm việc
        $_SESSION['login_attempts'] = 0;
        // Chuyển hướng đến trang chủ
        header("Location: dashboard.php");
        exit();
    } else {
        // Tăng số lần đăng nhập sai
        if (isset($_SESSION['login_attempts'])) {
            $error_message = "Tên người dùng hoặc mật khẩu sai";
            $_SESSION['login_attempts']++;
            $remaining_attempts = 5 - $_SESSION['login_attempts'];
            $error_message .= ".<br>Bạn còn $remaining_attempts lần";
        } else {
            $_SESSION['login_attempts'] = 1;
        }
        // Kiểm tra số lần đăng nhập sai
        if ($_SESSION['login_attempts'] >= $max_login_attempts) {
            // Nếu nhập sai quá số lần cho phép, chuyển hướng đến trang quên mật khẩu
            header("Location: forgotpassword.php");
            exit();
        } else {
            // Hiển thị thông báo lỗi hoặc chuyển hướng người dùng đến trang đăng nhập
        }
    }
}
$conn->close();
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
            margin: 0px;
            /*position: relative; /* Thiết lập phần tử trong vị trí tương đối */
            /*top: -5px; /* Điều chỉnh khoảng cách từ phía trên của phần tử h2 */
            /* left: 0px; */
        }
       
        .error-message {
            color: red;
            font-size: 1em; /* Thay đổi kích thước font về đơn vị em */
            padding: 10px;
        /*  position: absolute; /* Cung cấp vị trí cố định */
        /*  top: 39%; /* Vị trí từ phía trên của màn hình */
        /*  left: 67%; /* Vị trí từ phía trái của màn hình */
        /*  transform: translate(-40%, -65%); /* Dịch chuyển error message về trung tâm của màn hình */
        }
        @media only screen and (max-width: 768px) {
            .error-message {
                font-size: 0.8em; /* Giảm kích thước font cho kích thước màn hình nhỏ hơn */
            }
        }

        @media only screen and (max-width: 480px) {
            .error-message {
                font-size: 0.6em; /* Giảm kích thước font cho kích thước màn hình nhỏ hơn */
            }
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
                <div class="error-message" id="error-message"><?php echo isset($error_message) ? $error_message : ''; ?></div>
                    <script>
                        // Hàm hiển thị thông báo lỗi
                        function validateForm() {
                            var errorMessageContainer = document.getElementById("error-message");
                            errorMessage.style.display = "<?php echo isset($error_message) && !empty($error_message) ? 'block' : 'none'; ?>";
                         return true; // Trả về true nếu muốn form tiếp tục submit, ngược lại trả về false
                        }

                        // Hàm xóa thông báo lỗi
                        function clearErrorMessage() {
                            var errorMessageContainer = document.getElementById("error-message");
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
        </div>
    </div>
</div>
</body>
</html>