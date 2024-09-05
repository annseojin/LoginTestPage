<?php
session_start();
session_destroy(); 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그아웃</title>
    <script>
        alert('로그아웃되었습니다.');
        location.replace('login.php');
    </script>
</head>
<body>
</body>
</html>
