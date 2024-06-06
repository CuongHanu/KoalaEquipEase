<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$servername = "localhost";
$dbusername = "id21996215_cuongtq203";
$password = "Cuong2k3@";
$dbname = "id21996215_equipease";

$conn = new mysqli($servername, $dbusername, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$showSuccessPopup = false;
$showErrorPopup = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $status = $_POST['status'];
    $location = $_POST['location'];
    $purchase_date = $_POST['purchase_date'];
    $note = $_POST['note'];
    $warranty_end_date = isset($_POST['warranty_end_date']) ? $_POST['warranty_end_date'] : NULL;
    $value = $_POST['value'];
    // Kiểm tra xem tên thiết bị đã tồn tại chưa
    $checkSql = "SELECT COUNT(*) AS count FROM Device WHERE name = '$name'";
    $result = $conn->query($checkSql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        // Tên thiết bị đã tồn tại
        $showErrorPopup = true;
    } else {
        // Thêm thiết bị mới
        $insertSql = "INSERT INTO Device (name, quantity, unit, status, location, purchase_date, warranty_end_date, value, note) VALUES ('$name', '$quantity', '$unit', '$status', '$location', '$purchase_date', ";
        if ($warranty_end_date === NULL) {
            $insertSql .= "NULL, ";
        } else {
            $insertSql .= "'$warranty_end_date', ";
        }
        $insertSql .= "'$value', '$note')";


        if ($conn->query($insertSql) === TRUE) {
            $message = "$username đã thêm thiết bị $name.";
            $notificationSql = "INSERT INTO Notifications (message) VALUES ('$message')";
            $conn->query($notificationSql);

            $showSuccessPopup = true;
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
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
            width: 80%;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, textarea, select {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .cancel-btn {
            background-color: #dc3545;
        }
        .cancel-btn:hover {
            background-color: #c82333;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 40px;
            border-radius: 10px;
            z-index: 9999;
            font-size: 18px;
        }
        .success-popup {
            background-color: #4CAF50;
            color: white;
        }
        .error-popup {
            background-color: #dc3545;
            color: white;
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
        <h1>Thêm Thiết Bị</h1>
        <form method="POST" id="addForm">
            <label for="name">Tên thiết bị:</label>
            <input type="text" id="name" name="name" required>

            <label for="quantity">Số lượng:</label>
            <input type="number" id="quantity" name="quantity" required>
            
            <label for="unit">Đơn vị:</label>
            <input type="text" id="unit" name="unit" required>

            <label for="status">Tình trạng:</label>
            <select id="status" name="status" required>
                <option value="Bình thường">Bình thường</option>
                <option value="Đang bảo trì">Đang bảo trì</option>
                <option value="Cần bảo trì">Cần bảo trì</option>
            </select>

             <label for="location">Vị trí:</label>
            <input type="text" id="location" name="location" required>

            <label for="purchase_date">Ngày sử dụng:</label>
            <input type="date" id="purchase_date" name="purchase_date" required>

            <label for="warranty_end_date">Ngày hết bảo hành:</label>
            <input type="date" id="warranty_end_date" name="warranty_end_date">
            
            <label for="value">Giá trị:</label>
            <input type="text" id="value" name="value" required>
            
            <label for="note">Ghi chú:</label>
            <textarea id="note" name="note"></textarea>

            <div class="buttons">
                <button type="submit">Lưu</button>
                <button type="button" class="cancel-btn" onclick="window.history.back()">Hủy</button>
            </div>
        </form>
    </div>

    <div class="popup success-popup" id="successPopup">
        Lưu thành công
    </div>

    <div class="popup error-popup" id="errorPopup">
        Vật phẩm đã tồn tại. Vui lòng cập nhật lại
    </div>

    <?php if ($showSuccessPopup): ?>
        <script>
            document.getElementById('successPopup').style.display = 'block';
            setTimeout(() => {
                window.history.go(-2)();
            }, 3000); // Hiển thị popup trong 3 giây sau đó điều hướng về trang trước đó
        </script>
    <?php endif; ?>

    <?php if ($showErrorPopup): ?>
        <script>
            document.getElementById('errorPopup').style.display = 'block';
            setTimeout(() => {
                document.getElementById('errorPopup').style.display = 'none';
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
