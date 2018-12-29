# confession
Confession website


### Hướng dẫn cài đặt
1. Download và giải nén ra 1 folder trong htdocs
2. Import file sql vào mysql
3. Cấu hình file host trỏ confession.com -> local
4. Cấu hình csdl trong file config.php (đỗi username và password)
5. Thêm tên miền ảo confession.com vào xampp (file httpd-vhosts.conf) ([xem chi tiết](https://thachpham.com/thu-thuat/cach-them-ten-mien-ao-cho-localhost-voi-xampp.html))
6. Truy cập http://confession.com


### Chức năng của admin:
Truy cập: http://confession.com/admin/login.php
Có thể đăng nhập với tài khoản admin@gmail.com | password
Hoặc đăng nhập với Google (thêm email vào bảng admin)


#### Toàn bộ phần mã nguồn javascript nằm ở file `public\mainv2.js` (người dùng) và `admin\public\js\admin.js` (admin)
#### Bắt buộc cấu hình tên miền ảo confession.com thì mới sử dụng được