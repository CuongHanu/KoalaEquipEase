<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
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
        .navbar .home-link {
            color: white; /* Màu chữ cho Home */
        }
        .navbar .notification-link {
            color: #00CC00; /* Màu chữ cho Thông báo */
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
        .notification .timestamp {
            font-size: smaller;
            color: #555;
            margin-top: 5px;
        }
        .notification .details {
            font-size: smaller;
            color: #333;
            margin-top: 5px;
        }
        .back-button {
            position : absolute;
            top : 100px;
            margin-left : -100px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            margin-top: 0;
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
    <a href="dashboard.php" class="home-link">
        <img src="https://lh3.googleusercontent.com/-YXPNJjjvGu4/ZksFapsNkaI/AAAAAAAAAXI/tSGLyhifizQgKPOyXS2dJSdOaAHnP0YqwCNcBGAsYHQ/h120/Profile.png" alt="Home">
        Home
    </a>
    <a href="notification.php" class="notification-link">
        <img src="https://lh3.googleusercontent.com/-BRBdMk2g6II/ZkjlJFFWO3I/AAAAAAAAAWg/9JPj5dTgKA0wM5YE8BLNUwmeATeecN1tgCNcBGAsYHQ/h120/B%25C3%25ACnh%2Bth%25C6%25B0%25E1%25BB%259Dng%2B%25282%2529.png" alt="Thông báo">
        Thông báo
    </a>
    <div class="user" id="userContainer">
        <img src="https://lh3.googleusercontent.com/-BdAyKAfgh5g/ZksXPrILYfI/AAAAAAAAAXY/ks7dtlGRRXE0KUu80D3Pnvuf49i6UDD3QCNcBGAsYHQ/h120/Profile%25281%2529.png" alt="User">
        <div class="user-options" id="userOptions">
            <a href="profile.php">Xem thông tin</a>
            <a href="changepassword.php">Đổi mật khẩu</a>
            <a href="logout.php">Đăng xuất</a>
        </div>
    <span><?php echo $username; ?></span>
  </div>
</div>
<div class="container">
    <a href="dashboard.php" class="back-button">Quay lại</a>
    <div class="notifications">
        <h2>Thông báo</h2>
        <?php
        $servername = "localhost";
        $dbusername = "id21996215_cuongtq203";
        $dbpassword = "Cuong2k3@";
        $dbname = "id21996215_equipease";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT message, details, created_at FROM Notifications ORDER BY created_at DESC";
        $result = $conn->query($sql);
        $count = 1;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='notification'>";
                echo "<p>" . $count . ". " . $row["message"] . "</p>";
                echo "<p class='timestamp'>" . $row["created_at"] . "</p>";
                echo "<p class='details'>" . $row["details"] . "</p>";
                echo "</div>";
                $count++;
            }
        } else {
            echo "<p>Không có thông báo nào.</p>";
        }
        $conn->close();
        ?>
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
