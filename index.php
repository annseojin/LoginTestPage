<?php
session_start(); // 세선 시작

// $_SESSION['user_id']가 설정되어 있지 않은지 확인
if(!isset($_SESSION['user_id'])) { 
  echo "<script>location.replace('login.php');</script>";
} else {
  // 사용자가 로그인에 성공한 경우
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  echo "<script>alert('Login Success!!!!');</script>";
} ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <script>
        function confirmLogout() {
            if (confirm("정말 로그아웃 하시겠습니까?")) {
                location.href = 'logout.php'; // 로그아웃 페이지로 이동
            }
        }
    </script>
</head>
<body>
  <div class="base">
    <h2><?php echo "HI, $username!!";?></h2>
    <button type="button" class="btn" onclick="confirmLogout()">LOGOUT</button>
  </div>
</body>