<?
	session_start();
    
	//환경설정 파일
	include_once "include/global.php"; 			//변수정보
	include_once "include/function.php"; 		//함수정보
	include_once "include/dbi.php"; 			//DB 연결정보
	include_once "include/page.class.php"; 		//페이지 클래스

	mysqli_query ($my_db,"set names utf8");


?>
