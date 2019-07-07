<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh UPDATE
if(isset($_POST['btnCapNhat']))
{
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $httt_ma = $_POST['httt_ma'];
    $httt_ten = $_POST['httt_ten'];

    // Câu lệnh INSERT
    $sql = "INSERT INTO `hinhthucthanhtoan` (httt_ma, httt_ten)
            VALUES ('" . $httt_ma . "', '". $httt_ten ."');";

    // Thực thi INSERT
    mysqli_query($conn, $sql);

    // Đóng kết nối
    mysqli_close($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/hinhthucthanhtoan/create.html.twig`
echo $twig->render('backend/hinhthucthanhtoan/create.html.twig');
