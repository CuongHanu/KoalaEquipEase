<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Chuyển hướng người dùng về trang đăng nhập nếu chưa đăng nhập
    header("Location: login.php");
    exit();
}

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
            $username = "id21996215_cuongtq203";
            $password = "Cuong2k3@";
            $dbname = "id21996215_equipease";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn thông tin người dùng từ cơ sở dữ liệu
$sql = "SELECT * FROM Users WHERE user_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Lấy thông tin người dùng từ kết quả truy vấn
    $row = $result->fetch_assoc();
    $fullname = $row['full_name'];
    $department = $row['department'];
    $phone = $row['phone_number'];
    $email = $row['email'];
    $username = $row['user_name'];
} else {
    echo "Không tìm thấy thông tin người dùng.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông báo</title>
    <style>
        body {
            font-family: 'Roboto Slab', 'Noto Serif Display', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
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
        .navbar .user-link {
            color: #00CC00; /* Màu chữ cho user */
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

        /* CSS styles for profile box */
        .profile-box {
            width: calc(100% - 40px); /* Chiều ngang gần hết màn hình, giả sử padding và margin là 20px */
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #ccc; /* Màu xám của phần nền */
        }

        .profile-info {
            background-color: white; /* Màu nền của các ô chứa thông tin */
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px; /* Bo tròn góc */
        }

        .profile-label {
            font-weight: bold;
            color: black; /* Màu chữ */
        }

        .profile-value {
            color: black; /* Màu chữ */
        }

        /* CSS styles for Back button */
        .back-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
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
<div class="profile-box">
    <h2>Thông tin người dùng</h2>
    <div class="profile-info">
        <span class="profile-label">Họ và tên:</span>
        <span class="profile-value"><?php echo $fullname; ?></span>
    </div>
    <div class="profile-info">
        <span class="profile-label">Bộ phận làm việc:</span>
        <span class="profile-value"><?php echo $department; ?></span>
    </div>
    <div class="profile-info">
        <span class="profile-label">Số điện thoại:</span>
        <span class="profile-value"><?php echo $phone; ?></span>
    </div>
    <div class="profile-info">
        <span class="profile-label">Email:</span>
        <span class="profile-value"><?php echo $email; ?></span>
    </div>
    <div class="profile-info">
        <span class="profile-label">Tên đăng nhập:</span>
        <span class="profile-value"><?php echo $username; ?></span>
    </div>
    <button class="back-button" onclick="goBack()">Quay lại</button>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>
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
