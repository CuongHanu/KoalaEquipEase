<?php
session_start();
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
$location = $_GET['location'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
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
        .bottom-section {
            background-color: #ffffff;
            padding: 10px; /* Tăng giá trị padding */
            text-align: center;
            border-radius: 20px; /* Bo tròn góc */
        }
        
        h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: 50px; /* Điều chỉnh khoảng cách giữa tiêu đề và bảng */
        }
        .class-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: -40px;
        }
        .class-box {
            width: 80%;
            max-width: 1000px;
            height: 80px;
            background-color: #4CAF50;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: black;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .class-name {
            width: 20%;
            text-align: center;
            margin-top: -6%;
        }
        .class-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 10px;
        }
        .back-btn {
          position: absolute;
          top: 140px;
          left: 10px;
          padding: 10px 20px;
          background-color: #007bff;
          color: white;
          border: none;
          border-radius: 5px;
          cursor: pointer;
           margin-right: 20px;
        }
        .add-btn {
            position: absolute;
            top: 150px;
            padding: 6px 20px;
            background-color: #007bff; /* Màu nền xanh */
            color: black; /* Chữ màu đen */
            border: none;
            border-radius: 7px;
            cursor: pointer;
            margin-right: 300px;
        }
        
        .add-btn:hover {
            background-color: #0056b3; /* Màu xanh đậm khi di chuột qua */
        }
        
        .search-box {
            position: absolute;
            top: 150px;
            right: 80px; /* Điều chỉnh khoảng cách từ phải màn hình */
            height: 30px; /* Đặt chiều cao của ô tìm kiếm */
            display: flex;
            align-items: center;
            background-color: white;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .search-box input[type="text"] {
            flex: 1;
            border: none;
            background-color: transparent;
            padding: 0 5px; /* Giảm padding và loại bỏ khoảng cách trên dưới */
            color: black;
            outline: none;
            height: 100%; /* Chiều cao bằng với ô tìm kiếm */
        }
        .search-box button[type="submit"] {
            background-color: #007bff;
            border: none;
            cursor: pointer;
            padding: 0 10px; /* Giảm padding và loại bỏ khoảng cách trên dưới */
            border-radius: 5px;
            height: 100%; /* Chiều cao bằng với ô tìm kiếm */
        }
        .search-box button[type="submit"] img {
            height: 20px; /* Chiều cao của hình ảnh kính lúp */
            width: auto;
        }
        .search-box button[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            background-color: lightgray;
            width: 90%;
            margin: 60px auto;
            border-collapse: collapse;
            border-radius: 10px; /* Bo tròn góc */
            overflow: hidden; /* Ẩn phần dư thừa nếu bảng dài */
        }
        
        th, td {
            padding: 12px; /* Tăng padding để phù hợp với kích thước lớn hơn của bảng */
            border: none;
            text-align: center;
        }
        
        tr:first-child {
            border-bottom: 3px solid black; /* Dòng ngang màu đen */
        }
        
        td:nth-child(8), td:nth-child(9) {
            border-right: 3px solid black;
            position: relative;
        }
        
        .edit, .delete {
            color: #ff0000;
            text-decoration: none;
            font-weight: bold;
            margin: 0 2px; /* Giảm khoảng cách giữa các nút */
            padding: 2px 5px; /* Giảm padding của nút */
        }
        .odd {
            background-color: #f8f9fa;
        }
        .pagination {
            margin-top: 20px;
            text-align: right; /* Căn phải */
        }
        
        .pagination ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: flex-end; /* Chuyển từ căn phải sang căn phải và dịch chuyển nút trang sang trái */
            align-items: center;
        }
        
        .pagination li {
            margin-right: 5px;
        }
        
        .pagination li a {
            text-decoration: none;
            padding: 5px;
            background-color: white;
            color: black;
            border-radius: 50%;
            display: inline-block;
            width: 25px; /* Đặt kích thước cố định cho hình tròn */
            height: 25px; /* Đặt kích thước cố định cho hình tròn */
            text-align: center;
            line-height: 25px; /* Canh chỉnh văn bản vào giữa nút */
            font-size: 14px;
            border: 2px solid black; /* Viền đậm hơn */
        }
        
        .pagination li a.active {
            background-color: #28a745; /* Nền xanh lá */
            color: white; /* Chữ trắng */
        }
        
        
        .pagination li a:hover {
            background-color: #f5f5f5;
        }
        
        }
        
        #editBox {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 10px;
        }
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        
        .popup-content {
            background-color: white;
            padding: 40px 60px; /* Tăng kích thước của popup */
            border-radius: 10px; /* Bo tròn các góc của popup */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        
        .btn-confirm, .btn-cancel {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin: 10px;
            border-radius: 10px; /* Bo tròn các nút */
        }
        
        .btn-confirm {
            background-color: red;
            color: white;
        }
        
        .btn-cancel {
            background-color: gray;
            color: white;
        }
        
        .success-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 5px;
            z-index: 9999;
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
<div class="bottom-section">
  <div class="class-actions">
    <button <a href="back.php" class="back-btn">Quay lại<a/></button>
    <a class="add-btn" id="addLink" href="add.php" onclick="toggleEditBox()">Thêm</a>
    <form method="post" action="search.php" class="search-box">
    <input type="text" name="search_term" placeholder="Tìm kiếm...">
    <button type="submit" name="submit_search">
        <img src="https://lh3.googleusercontent.com/-P31iGBmznm4/Zkc-Yi2m0pI/AAAAAAAAAWU/7RPl_uFSOXoiFY3By4ivZEN3mbdXuFrlwCNcBGAsYHQ/h120/snapedit_1715945043668.png" alt="Search">
    </button>
</form>
  </div>
    <div class="class-container">
        <h1><?php echo "Danh sách thiết bị ở " . $_GET['location']; ?></h1>
        <?php
        $servername = "localhost";
        $db_username = "id21996215_cuongtq203";
        $password = "Cuong2k3@";
        $dbname = "id21996215_equipease";

        $conn = new mysqli($servername, $db_username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $location = $_GET['location'];

        $sql = "SELECT * FROM Device WHERE location = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $location);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Tên thiết bị</th><th>Số lượng</th><th>Đơn vị</th><th>Tình trạng</th><th>Ngày mua</th><th>Ngày hết bảo hành</th><th>Giá trị</th><th>Ghi chú</th></tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td>" . $row["unit"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["purchase_date"] . "</td>";
                    echo "<td>" . $row["warranty_end_date"] . "</td>";
                    echo "<td>" . $row["value"] . "</td>";
                    echo "<td>" . $row["note"] . "</td>";
                    echo "<td><a class='edit' href='update.php?id=" . $row["device_id"] . "'>Sửa</a></td>";
                    echo "<td><span class='delete' data-device-id='" . $row['device_id'] . "' data-device-name='" . $row['name'] . "'>Xóa</span></td>";
                    echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Không có thiết bị nào trong lớp học này.";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</div>
<div class="pagination">
    <ul id="pagination-buttons">
        <?php
            $servername = "localhost";
            $username = "id21996215_cuongtq203";
            $password = "Cuong2k3@";
            $dbname = "id21996215_equipease";

            // Kết nối tới cơ sở dữ liệu
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Lấy giá trị của location từ GET
            $location = isset($_GET['location']) ? $_GET['location'] : '';

            // Số lượng dòng trên mỗi trang
            $rowsPerPage = 5;

            // Sử dụng prepared statement để đếm tổng số dòng
            $sql_total = "SELECT COUNT(*) AS total_rows FROM Device WHERE location = ?";
            $stmt_total = $conn->prepare($sql_total);
            if ($stmt_total === false) {
                die('Prepare failed: ' . $conn->error);
            }
            $stmt_total->bind_param("s", $location);
            $stmt_total->execute();
            $result_total = $stmt_total->get_result();
            $row_total = $result_total->fetch_assoc();
            $totalRows = isset($row_total['total_rows']) ? $row_total['total_rows'] : 0;
            $stmt_total->close();

            // Tính toán số lượng trang dựa trên tổng số dòng và số dòng trên mỗi trang
            $totalPages = $totalRows > 0 ? ceil($totalRows / $rowsPerPage) : 1;

            // Lấy giá trị của currentPage từ GET, nếu không có thì mặc định là trang 1
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // Tính toán số lượng thiết bị cần hiển thị trên trang hiện tại
            $offset = ($currentPage - 1) * $rowsPerPage;
            $devicesToShow = min($rowsPerPage, $totalRows - $offset);

            // Hiển thị các nút phân trang
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($currentPage == $i) ? "active" : "";
                echo "<li><a href='?page=$i&location=" . urlencode($location) . "' class='$activeClass'>$i</a></li>";
            }
        ?>
    </ul>
    <div class="page-info">Trang <?php echo $currentPage; ?> của <?php echo $totalPages; ?></div>
</div>



<div class="popup-overlay" id="confirmationOverlay">
    <div class="popup-content">
        <h2>Xác nhận xóa</h2>
        <p id="deviceName"></p>
        <button class="btn-confirm">Xóa</button>
        <button class="btn-cancel">Hủy</button>
    </div>
</div>

<div class="success-popup" id="successPopup">
    <p>Thiết bị đã được xóa thành công</p>
</div>

<script>
    // JavaScript code for handling delete button click
    document.querySelectorAll('.delete').forEach(btn => {
    btn.addEventListener('click', () => {
        const deviceId = btn.getAttribute('data-device-id');
        const deviceName = btn.getAttribute('data-device-name');
        document.getElementById('deviceName').innerText = deviceName;
        document.getElementById('confirmationOverlay').style.display = 'flex';

        // Xác nhận xóa thiết bị
        document.querySelector('.btn-confirm').addEventListener('click', () => {
            // Sử dụng Ajax để gửi yêu cầu xóa thiết bị đến server
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Hiển thị popup xóa thành công
                    document.getElementById('successPopup').style.display = 'block';
                    setTimeout(() => {
                        document.getElementById('successPopup').style.display = 'none';
                        window.location.reload(); // Tải lại trang sau khi xóa thành công
                    }, 5000);
                }
            };
            xhr.open("POST", "delete.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("device_id=" + deviceId);
        });

        // Hủy thao tác xóa
        document.querySelector('.btn-cancel').addEventListener('click', () => {
            document.getElementById('confirmationOverlay').style.display = 'none';
        });
    });
});
</script>
<script>
    document.querySelector('.back-btn').addEventListener('click', function() {
        window.history.back();
    });
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
