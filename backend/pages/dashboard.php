<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$stt=1;
$sqlSoLuongSanPham = "select count(*) as SoLuong from `sanpham`";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlSoLuongSanPham);

// 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
$dataSoLuongSanPham = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $dataSoLuongSanPham[] = array(
        'SoLuong' => $row['SoLuong']
    );
}

// Nếu trong SESSION không có giá trị của key 'username', chúng ta sẽ xem như người dùng chưa đăng nhập
// Điều hướng người dùng về trang Đăng nhập
// RECOMMENDED: Nên ràng buộc kỹ hơn về phân quyền,
if(!isset($_SESSION['username']))
{
    header('location:./../pages/login.php');
}

// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/pages/dashboard.html.twig`
// với dữ liệu truyền vào file giao diện được đặt tên là `products`
echo $twig->render('backend/pages/dashboard.html.twig', [
    'baocaoSanPham' => $dataSoLuongSanPham[0]
]);
