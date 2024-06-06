<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "id21996215_cuongtq203";
$password = "Cuong2k3@";
$dbname = "id21996215_equipease";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy email từ form
    $email = $_POST['email'];
    if (empty($email)) {
        $error_message = "Không được để email trống";
    }else{
        $sql = "SELECT * FROM Users WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            $error_message = "Địa chỉ email không hợp lệ.";
        }else{
    // Tạo mật khẩu mới
    $new_password = 'Koala@' . mt_rand(100, 999);

    // Cập nhật mật khẩu mới vào cơ sở dữ liệu
        $sql = "UPDATE Users SET password='$new_password' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
        // Gửi mật khẩu mới qua email
            if (sendNewPassword($email, $new_password)) {
                $error_message = "Mật khẩu mới đã được đặt lại và gửi qua email.";
                header("Location: login.php");
            } else {
                $error_message = "Đã có lỗi xảy ra khi gửi email.";
                header("Location: login.php");
            }
        } else {
            $error_message = "Đã xảy ra lỗi khi cập nhật mật khẩu mới vào cơ sở dữ liệu.";
        }
    }
}
}
function sendNewPassword($email, $new_password) {
    // Gửi email chứa mật khẩu mới

    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Địa chỉ SMTP server của bạn
        $mail->SMTPAuth = true;
        $mail->Username = 'trinhcuong9923@gmail.com'; // Địa chỉ email của bạn
        $mail->Password = 'peci xtvf hywd tbgx'; // Mật khẩu email của bạn
        $mail->SMTPSecure = 'tls'; // Phương thức bảo mật (tls hoặc ssl)
        $mail->Port = 587; // Cổng SMTP

        // Cấu hình email
        $mail->setFrom('trinhcuong9923@gmail.com', 'Koala Education Center'); // Địa chỉ và tên người gửi
        $mail->addAddress($email); // Địa chỉ email của người nhận

        // Nội dung email
        $mail->isHTML(true); // Đặt email thành định dạng HTML
        $mail->Subject = 'Mật khẩu mới'; // Tiêu đề email
        $mail->Body    = 'Mật khẩu mới của bạn là: ' . $new_password; // Nội dung email

        // Gửi email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
    $_SESSION['reset_password_success'] = true;

// Chuyển hướng đến trang quên mật khẩu
header("Location: forgotpassword.php");
exit();
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
            position: relative; /* Thiết lập phần tử trong vị trí tương đối */
            top: -5px; /* Điều chỉnh khoảng cách từ phía trên của phần tử h2 */
            left: 0px;
        }
       
        .error-message {
            color: red;
            font-size: 1em; /* Thay đổi kích thước font về đơn vị em */
            position: fixed; /* Cung cấp vị trí cố định */
            top: 46%; /* Vị trí từ phía trên của màn hình */
            left: 68%; /* Vị trí từ phía trái của màn hình */
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
</body>
</html>