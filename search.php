<?php
session_start();
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
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
            padding: 10px;
            text-align: center;
            border-radius: 20px;
        }
        
        h1 {
            font-size: 36px;
            font-weight: bold;
            margin-top: -1%;
        }
        
        .class-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
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
            width: 100%;
            text-align: center;
            margin-top: 20px;
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

.search-results {
    text-align: center;
    margin-top: 0;
    margin-bottom: 20px;
}

.result-table {
    width: 100%;
    overflow-x: auto;
    margin-top: 20px;
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
        
        td:nth-child(9), td:nth-child(10) {
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
        .search-results {
    text-align: center; /* Căn giữa tiêu đề */
    margin-top: 40px; /* Điều chỉnh khoảng cách từ tiêu đề đến bảng */
    margin-bottom: 20px; /* Điều chỉnh khoảng cách từ bảng đến các phần khác */
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
        <button class="back-btn">Quay lại</button>
        <a class="add-btn" id="addLink" href="add.php" onclick="toggleEditBox()">Thêm</a>
        <form method="post" action="search.php" class="search-box">
            <input type="text" name="search_term" placeholder="Tìm kiếm...">
            <button type="submit" name="submit_search">
                <img src="https://lh3.googleusercontent.com/-P31iGBmznm4/Zkc-Yi2m0pI/AAAAAAAAAWU/7RPl_uFSOXoiFY3By4ivZEN3mbdXuFrlwCNcBGAsYHQ/h120/snapedit_1715945043668.png" alt="Search">
            </button>
        </form>
    </div>

    <div class="search-results">
        <h1>Kết quả tìm kiếm</h1>
    </div>

    <div class="class-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_search"])) {
            // Kết nối đến cơ sở dữ liệu (ví dụ: MySQL)
            $servername = "localhost";
            $username = "id21996215_cuongtq203";
            $password = "Cuong2k3@";
            $dbname = "id21996215_equipease";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
            }

            $searchTerm = $_POST["search_term"];

            // Truy vấn trong cơ sở dữ liệu
            $sql = "SELECT * FROM Device WHERE name LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Nếu tìm thấy, hiển thị thông tin vật phẩm trong bảng
                echo "<div class='result-table'>";
                echo "<table border='1'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Thiết bị</th>";
                echo "<th>Số lượng</th>";
                echo "<th>Đơn vị</th>";
                echo "<th>Tình trạng</th>";
                echo "<th>Vị trí</th>";
                echo "<th>Ngày sử dụng</th>";
                echo "<th>Ngày hết bảo hành</th>";
                echo "<th>Giá trị</th>";
                echo "<th>Ghi chú</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["quantity"]."</td>";
                    echo "<td>".$row["unit"]."</td>";
                    echo "<td>".$row["status"]."</td>";
                    echo "<td>".$row["location"]."</td>";
                    echo "<td>".$row["purchase_date"]."</td>";
                    echo "<td>".$row["warranty_end_date"]."</td>";
                    echo "<td>".$row["value"]."</td>";
                    echo "<td>".$row["note"]."</td>";
                    echo "<td><a class='edit' href='update.php?id=" . $row['device_id'] . "'>Sửa</a></td>";
                    echo "<td><span class='delete' data-device-id='" . $row['device_id'] . "' data-device-name='" . $row['name'] . "'>Xóa</span></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                // Nếu không tìm thấy, hiển thị thông báo
                echo "Không tìm thấy vật phẩm.";
            }

            // Đóng kết nối đến cơ sở dữ liệu
            $conn->close();
        }
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
