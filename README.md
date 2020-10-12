
# StudentManagement

A website support upload and download homework, manage profile students and chat with other users! Create with Laravel and MySQL.

# Yêu cầu

Lập trình bằng ngôn ngữ PHP (yêu cầu không sử dụng framework có sẵn),
sử dụng DB MySQL để xây dựng website quản lý thông tin sinh viên, tài liệu
của 1 lớp học.

Yêu cầu ứng dụng:

- Giao diện website rõ ràng, sạch đẹp (có sử dụng HTML, CSS để định dạng và thiết kế website) (1đ)
- Đăng ký tài khoản và tạo project trên github để quản lý code (0.5đ)
- Deploy ứng dụng lên server public (0.5đ)

Yêu cầu chức năng:

- Giáo viên có thể thêm, sửa, xóa các thông tin của sinh viên. Thông tin có
các trường cơ bản gồm: tên đăng nhập, mật khẩu, họ tên, email, số điện
thoại (1đ)
- Sinh viên sau khi đăng nhập được phép thay đổi các thông tin của mình
trừ tên đăng nhập và họ tên (1đ).
- Một người dùng (giáo viên hoặc sinh viên) bất kỳ đc phép xem danh
sách các người dùng trên website và xem thông tin chi tiết của một
người dùng khác. Tại trang xem thông tin chi tiết của một người dùng có
mục để lại tin nhắn cho người dùng đó, có thể sửa/xóa tin nhắn đã gửi
(2đ).
- Chức năng giao bài, trả bài:
  - Giáo viên có thể upload file bài tập lên. Các sinh viên có thể xem
danh sách bài tập và tải file bài tập về (1đ).
  - Sinh viên có thể upload bài làm tương ứng với bài tập được giao. Chỉ giáo viên mới nhìn thấy danh sách bài làm này (1đ).
- Tạo chức năng cho phép giáo viên tổ chức 1 trò chơi giải đố như sau:
  - Giáo viên tạo challenge, trong đó cần thực hiện: upload lên 1 file
txt có nội dung là 1 bài thơ, văn,…, tên file được viết dưới định
dạng không dấu và các từ cách nhau bởi 1 khoảng trắng. Sau đó
nhập gợi ý về challenge và submit. (Đáp án chính là tên file mà
giáo viên upload lên. Không lưu đáp án ra file, DB,…) (1đ)
  - Sinh viên xem gợi ý và nhập đáp án. Khi sinh viên nhập đúng thì
trả về nội dung bài thơ, văn,… lưu trong file đáp án (1đ).

# How I deploy this website to public

- I use 000webhost.  
- Follow this steps <https://www.000webhost.com/forum/t/deploy-laravel-project-into-000webhost-site/127323?__cf_chl_jschl_tk__=7f8d0ee4798f6ee19f7aaa57138f96f3ef83744c-1602300982-0-AfQK5b5y5cBRXDsNhp6sTyhYxiJ--0g7fMgSIK_mdajFeyJ0ugc83zdBEfU_1WeNMx4m9-lm65asLBYY6L9M08HVO9YQtAz47bQYkgEJRZMw1dIXpfQlVkB0jqTXWeKSD414H74lmK3ql1BQTs7ifcwKdDCLWEMnPpNM7_1KyQ2pEIMSCEPbNhcoj8FRAB2Y5GTz_IUNfYudM_rjb0QCJB3pZpPoqsaTBkIC9blUmZDg9hQ8YK6JcOVc9gxFyJzSzH56YwHMiZrJWuFU0E59AVYpzp3XMZYjp4AQq83eaxrVFvZtcgtsgQral5HmoZSaX5tUF8LCjRCg_BLbxB95gnjQk9mELQxgwnmU8GgjGrxa>. Remember to remove node_modules and zip file, sql file when upload file to web host.
- Note that we should config database connection in .env file to match database info in web host.
- We may encounter some problems when unzip file in 000webhost, try to use unzipper like this <https://www.000webhost.com/forum/t/ftp-put-cant-open-that-file-no-such-file-or-directory/77199>. After unzip remember to remove unzipper.php and related file to avoid some policy problems.
- Finally, export your local database and import to our database in web host. I made a simple database in laravelproject.sql, just import that to the database in our web host to create all tables. We have finished and may enjoy our website!
- **UPDATE 10/12/2020:** I have encountered a problem when uploading file, it uploaded to public instead of public_html. I need to go to 'config/filesystem.php' and change value of 'root' to '../public_html'. The problem with 000webhost is I have to use 'public_html' as default public folder while laravel project public folder is 'public'. ~~000webhost suck~~
