<?php
session_start();
echo "<script>alert('로그아웃되었습니다.');location.replace('login.php');</script>";
session_destroy(); 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
</body>
</html>
