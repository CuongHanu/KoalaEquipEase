<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

// Kết nối tới cơ sở dữ liệu
$servername = "localhost"; // Đổi thành tên máy chủ của bạn
$username_db = "id21996215_cuongtq203"; // Đổi thành tên người dùng của bạn
$password_db = "Cuong2k3@"; // Đổi thành mật khẩu của bạn
$dbname = "id21996215_equipease"; // Đổi thành tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn danh sách các phòng dựa vào location
$sql = "SELECT DISTINCT location FROM Device";
$result = $conn->query($sql);
$locations = [];

if ($result->num_rows > 0) {
    // Lấy dữ liệu từ kết quả truy vấn
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row['location'];
    }
} else {
    echo "0 results";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <style>
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
        .navbar .home-link {
            color: #00CC00; /* Màu chữ cho Home */
        }
        .navbar .notification-link {
            color: white; /* Màu chữ cho Thông báo */
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
        .notifications {
            background-color: white;
            margin-top: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .notification {
            background-color: #4CAF50;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            color: black;
        }
        .notification p {
            margin: 0;
            font-weight: bold;
        }
        /* New CSS for the bottom section */
        .bottom-section {
            background-color: #ffffff;
            text-align: center;
            padding: 20px 0;
        }
        h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .class-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .class-box {
            width: 80%; /* Chiều rộng của ô */
            max-width: 1000px; /* Chiều rộng tối đa của ô */
            height: 80px;
            background-color: #4CAF50;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: black;
            font-size: 20px;
            margin-bottom: 20px; /* Khoảng cách giữa các ô */
        }
        .class-name {
            width: 300%; /* Kéo dài khung chứa tên lớp gấp 3 lần */
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
    <a href="dashboard.php" class = "home-link">
        <img src="https://lh3.googleusercontent.com/-FiP8XCLyv6Q/ZkshK19V-hI/AAAAAAAAAXk/LzrjHVdg0twpmzPtkbL-vYyipVlFQ_csQCNcBGAsYHQ/h120/15.png" alt="Home">
        Home
    </a>
    <a href="notification.php">
        <img src="https://lh3.googleusercontent.com/-PJq0YIOuQj4/ZksE3Mqwf2I/AAAAAAAAAXA/4bqOqbmtDbsCuNOzycizEXLdPQ6o8SarACNcBGAsYHQ/h120/B%25C3%25ACnh%2Bth%25C6%25B0%25E1%25BB%259Dng.png" alt="Thông báo">
        Thông báo
    </a>
    <div class="user" id="userContainer">
        <img src="https://lh3.googleusercontent.com/-BdAyKAfgh5g/ZksXPrILYfI/AAAAAAAAAXY/ks7dtlGRRXE0KUu80D3Pnvuf49i6UDD3QCNcBGAsYHQ/h120/Profile%25281%2529.png" alt="User">
        <div class="user-options" id="userOptions">
            <a href="profile.php">Xem thông tin</a>
            <a href="changepassword.php">Đổi mật khẩu</a>
            <a href="logout.php">Đăng xuất</a>
        </div>
    <span><?php echo $_SESSION['username']; ?></span>
  </div>
</div>
<div class="bottom-section">
    <h1>Quản lí thiết bị</h1>
    <div class="class-container">
    <?php foreach ($locations as $location): ?>
        <a href="class.php?location=<?php echo urlencode($location); ?>" class="class-box class-name"> <?php echo htmlspecialchars($location); ?></a>
    <?php endforeach; ?>
    </div>
</div>
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