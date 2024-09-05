<?php
session_start();

// 데이터 베이스 접속 정보 설정
$host = 'localhost';
$user = 'test';
$pw = 'test';
$db_name = 'logintest';

// 데이터베이스 연결
$conn = new mysqli($host, $user, $pw, $db_name);
if ($conn->connect_error) {
    die("연결 실패: " . htmlspecialchars($conn->connect_error));
}

// 문자 인코딩 설정
$conn->set_charset("utf8mb4");

// POST 요청 처리 -> 사용자 입력값 가져오기
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['id'];  
    $user_pw = $_POST['pw'];

    // SQL 인젝션 방지 및 쿼리 실행
    $sql = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    if ($sql === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // 파라미터 바인딩, 's'-> 문자열
    $sql->bind_param("s", $user_id);

    // 쿼리 실행
    if (!$sql->execute()) {
        die('Execute failed: ' . htmlspecialchars($sql->error));
    }

    // 결과 바인딩
    $sql->store_result();
    $sql->bind_result($db_user_id, $db_username, $db_password);

    // 결과를 가져와서 처리
    if ($sql->fetch()) {
        // 비밀번호 검증
        if ($user_pw === $db_password) {
            // 로그인 성공, 세션 변수 설정
            session_regenerate_id(true); // 세션 아이디 재생성
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_username;

            // index.php로 리다이렉트
            header('Location: index.php');
            exit();
        } else {
            echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.');location.replace('login.php');</script>";
        }
    } else {
        echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.');location.replace('login.php');</script>";
    }

    // // 에러 메시지를 출력하지 않고 사용자에게 일반적인 메시지 제공
    // if (isset($error)) {
    //     echo '<p>' . htmlspecialchars($error) . '</p>';
    // }

    // SQL문 객체 종료
    $sql->close();
}
// 데이터베이스 연결 종료
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
</head>
