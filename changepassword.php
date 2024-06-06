<?php
session_start();
if (!isset($_SESSION['username'])) {
    die("User is not logged in");
}

$username = $_SESSION['username'];

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$dbusername = "id21996215_cuongtq203";
$password = "Cuong2k3@";
$dbname = "id21996215_equipease";

$conn = new mysqli($servername, $dbusername, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentPasswordError = '';
$newPasswordError = '';
$showSuccessPopup = false;

// Xử lý yêu cầu thay đổi mật khẩu khi có dữ liệu được gửi từ form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Thêm đoạn mã kiểm tra mật khẩu mới
    $uppercase = preg_match('@[A-Z]@', $new_password);
    $lowercase = preg_match('@[a-z]@', $new_password);
    $number    = preg_match('@[0-9]@', $new_password);
    $specialChars = preg_match('@[^\w]@', $new_password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 6) {
        $newPasswordError = "Mật khẩu mới phải bao gồm ít nhất 6 kí tự gồm chữ cái hoa, chữ cái thường, số và kí tự đặc biệt.";
    } else {
        // Truy vấn để lấy mật khẩu hiện tại của người dùng
        $sql = $conn->prepare("SELECT password FROM Users WHERE user_name = ?");
        if ($sql === false) {
            die("Prepare statement failed: " . $conn->error);
        }
        $sql->bind_param("s", $username);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $password_from_db = $row['password'];

            // Kiểm tra mật khẩu hiện tại
            if ($current_password === $password_from_db) {
                // Kiểm tra mật khẩu mới và xác nhận mật khẩu mới
                if ($new_password === $confirm_password) {
                    // Cập nhật mật khẩu mới vào cơ sở dữ liệu
                    $updateSql = $conn->prepare("UPDATE Users SET password = ? WHERE user_name = ?");
                    if ($updateSql === false) {
                        die("Prepare statement failed: " . $conn->error);
                    }
                    $updateSql->bind_param("ss", $new_password, $username);
                    if ($updateSql->execute()) {
                        $showSuccessPopup = true;
                    } else {
                        $newPasswordError = "Đã xảy ra lỗi, vui lòng thử lại.";
                    }
                    $updateSql->close();
                } else {
                    $newPasswordError = "Mật khẩu mới không khớp, vui lòng kiểm tra lại.";
                }
            } else {
                $currentPasswordError = "Mật khẩu hiện tại không đúng, vui lòng nhập lại.";
            }
        } else {
            $currentPasswordError = "Không tìm thấy người dùng.";
        }
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <style>
  /* CSS styles */
        body {
            font-family: 'Roboto Slab', 'Noto Serif Display', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .navbar {
            background-image: url("https://lh3.googleusercontent.com/-r1lMZCA_al8/Zfj3_q5-6KI/AAAAAAAAAQk/vL4ivlyn_i8w5PbOArsUsSRA9aQjMkPaACNcBGAsYHQ/s0/%25E1%25BA%25A3nh%2Bn%25E1%25BB%2581n%2Bsau.jpg");
            background-size: cover;
            background-position: center;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar img {
            height: 50px;
            margin-right: 10px;
        }
        .navbar a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: larger;
            display: flex;
            align-items: center;
        }
        .navbar a img {
            height: 30px;
            margin-right: 5px;
        }
        .navbar .user {
            display: flex;
            align-items: center;
        }
        .navbar .user img {
            height: 30px;
            margin-right: 5px;
        }
        .navbar .user span {
            font-weight: bold;
        }
        
        .container {
            text-align: center;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
        }
        button {
            padding: 10px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit {
            background-color: #28a745;
        }
        .btn-cancel {
            background-color: #dc3545;
        }
        .error {
            color: red;
            margin-top: 5px;
            text-align: left;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: white;
            padding: 40px;
            border-radius: 10px;
            z-index: 9999;
            font-size: 18px;
        }
        .navbar .user-link {
            color: #00CC00; /* Màu chữ cho user */
        }
        .user-options {
            display: none;
            position: absolute;
            top: 60px; /* Điều chỉnh vị trí xuất hiện của menu */
            right: 10px;
            background-color: white;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 10px;
            border-radius: 5px;
            z-index: 1000; /* Đảm bảo menu nằm trên các phần tử khác */
        }

        
        .user-options a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: black;
        }
        
        .user-options a:hover {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
    <div class="navbar">
    <img src="https://lh3.googleusercontent.com/-zGv4rCSXJg0/Zfj4Tdg4jHI/AAAAAAAAAQs/GrhpBwvxbLYtKmGv2SRxGL-GAr1D_tzHgCNcBGAsYHQ/h120/Logo%2BKoalahouse.png" alt="Logo">
    <a href="dashboard.php">
        <img src="https://lh3.googleusercontent.com/-YXPNJjjvGu4/ZksFapsNkaI/AAAAAAAAAXI/tSGLyhifizQgKPOyXS2dJSdOaAHnP0YqwCNcBGAsYHQ/h120/Profile.png" alt="Home">
        Home
    </a>
    <a href="notification.php">
        <img src="https://lh3.googleusercontent.com/-PJq0YIOuQj4/ZksE3Mqwf2I/AAAAAAAAAXA/4bqOqbmtDbsCuNOzycizEXLdPQ6o8SarACNcBGAsYHQ/h120/B%25C3%25ACnh%2Bth%25C6%25B0%25E1%25BB%259Dng.png" alt="Thông báo">
        Thông báo
    </a>
    <div class="user" id="userContainer">
        <img src="https://lh3.googleusercontent.com/-_FOq7kLJNvY/ZksS3BJuEtI/AAAAAAAAAXQ/_iQIsWaDD9YKgjgxYQVPxJH--43rVetzgCNcBGAsYHQ/h120/Profile.png" alt="User">
        <div class="user-options" id="userOptions">
            <a href="profile.php">Xem thông tin</a>
            <a href="changepassword.php">Đổi mật khẩu</a>
            <a href="logout.php">Đăng xuất</a>
        </div>
        <div class = "user-link">
            <span><?php echo $username; ?></span>
        </div>
  </div>
</div>
    <div class="container">
        <h1>Đổi mật khẩu</h1>
        <div class="form-container">
            <form method="POST" action="changepassword.php">
                <div class="form-group">
                    <input type="password" name="current_password" placeholder="Nhập mật khẩu hiện tại" required>
                    <?php if ($currentPasswordError): ?>
                        <p class="error"><?php echo $currentPasswordError; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="password" name="new_password" placeholder="Nhập mật khẩu mới" required>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu mới" required>
                    <?php if ($newPasswordError): ?>
                        <p class="error"><?php echo $newPasswordError; ?></p>
                    <?php endif; ?>
                </div>
                <div class="buttons">
                    <button type="submit" class="btn-submit">Hoàn tất</button>
                    <button type="button" class="btn-cancel" onclick="window.location.href='SR1B.php'">Hủy</button>
                </div>
            </form>
        </div>
    </div>

    <div class="popup" id="successPopup">
        Đổi mật khẩu thành công
    </div>

    <?php if ($showSuccessPopup): ?>
        <script>
            document.getElementById('successPopup').style.display = 'block';
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 5000);
        </script>
    <?php endif; ?>
<script>
    document.getElementById('userContainer').addEventListener('click', function() {
    var options = document.getElementById('userOptions');
    if (options.style.display === 'none' || options.style.display === '') {
        options.style.display = 'block';
    } else {
        options.style.display = 'none';
    }
});

// Đóng menu khi nhấp ra ngoài
document.addEventListener('click', function(event) {
    var container = document.getElementById('userContainer');
    if (!container.contains(event.target)) {
        document.getElementById('userOptions').style.display = 'none';
    }
});
</script>
</body>
</html>
