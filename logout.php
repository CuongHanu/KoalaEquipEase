<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>
<?php
// Đặt các tiêu đề để ngăn trang được lưu vào cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Xuất</title>
    <!-- CSS styles -->
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
            padding: 40px 60px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .btn-confirm,
        .btn-cancel {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin: 10px;
            border-radius: 10px;
        }

        .btn-confirm {
            background-color: red;
            color: white;
        }

        .btn-cancel {
            background-color: gray;
            color: white;
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
    <!-- Popup xác nhận -->
    <div class="popup-overlay" id="confirmationOverlay">
        <div class="popup-content">
            <h2>Bạn có chắc chắn muốn đăng xuất?</h2>
            <form id="logoutForm" method="post" action="logout.php">
                <button type="submit" class="btn-confirm" name="confirm_logout">Có</button>
                <button type="button" class="btn-cancel" id="cancelBtn">Hủy</button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmationOverlay = document.getElementById('confirmationOverlay');
            const logoutForm = document.getElementById('logoutForm');
            const cancelBtn = document.getElementById('cancelBtn');

            // Hiển thị popup xác nhận khi nhấn vào nút đăng xuất
            if (confirmationOverlay) {
                confirmationOverlay.style.display = 'flex';
            }

            // Xác nhận đăng xuất và chuyển hướng về trang index.php
            logoutForm.addEventListener('submit', function (event) {
                event.preventDefault(); // Ngăn chặn gửi form mặc định

                // Bạn cũng có thể sử dụng fetch hoặc XMLHttpRequest để gửi yêu cầu đăng xuất đồng thời chuyển hướng
                fetch('logout.php', {
                    method: 'POST',
                    body: new FormData(logoutForm)
                })
                .then(response => {
                    if (response.ok) {
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 500); // Chờ 0.5 giây trước khi chuyển trang để popup có thể biến mất trước khi chuyển hướng
                    } else {
                        console.error('Lỗi khi đăng xuất');
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi đăng xuất:', error);
                });
            });

            // Đóng popup khi nhấn nút hủy
            cancelBtn.addEventListener('click', function () {
                window.history.back(); // Quay lại trang trước đó
            });
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
