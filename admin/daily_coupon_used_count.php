<?php

//	include_once "./include/page.class.php";
include_once "./include/db_conn.php";
include "./head.php";

/* 
if(!$pg) $pg = 1;	// $pg가 없으면 1로 생성
$page_size = 20;	// 한 페이지에 나타날 개수
$block_size = 10;	// 한 화면에 나타낼 페이지 번호 개수

// 주차별 
$page_size = 7;
$block_size
*/

$applicant_count_main = '1';
$topgirl_vote_count_main = '2';
$story_vote_count_main = '3';
$coupon_used_count_main = '4';

$code_philippines = '1';
$code_taiwan = '2';
$code_indonesia = '3';
$code_singapore = '4';
?>


<div id="page-wrapper">
  <div class="container-fluid">
  <!-- Page Heading -->
    <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">일자별 쿠폰 사용자 수 PC / Mobile</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:display_daily_coupon_used_count(<?php echo $code_philippines; ?>)">PHILIPPINES</a></li>
        <li><a href="javascript:display_daily_coupon_used_count(<?php echo $code_taiwan; ?>)">TAIWAN</a></li>
        <li><a href="javascript:display_daily_coupon_used_count(<?php echo $code_indonesia; ?>)">INDONESIA</a></li>
        <li><a href="javascript:display_daily_coupon_used_count(<?php echo $code_singapore; ?>)">SINGAPORE</a></li>
      </ol>
    </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-6">
      <div class="table-responsive">
        <!-- 필리핀 -->
        <div id="daily_coupon_used_count_div1" style="display:block">
          <table class="table table-hover">
            <thead>
              <tr><th colspan="2">Philippines</th></tr>
              <tr><th>날짜</th><th>Total</th></tr>
            </thead>
            <tbody>
<?php
$daily_date_query = "SELECT regdate FROM event_topgirl_main Group by substr(regdate,1,10)";
$phi_daily_coupon_used_count_sum = 0;
$phi_res = mysqli_query($my_db, $daily_date_query);
	while($phi_daily_data = mysqli_fetch_array($phi_res))
	{
		$phi_daily_coupon_used_count_query = "SELECT count(*) FROM event_topgirl_prize_url WHERE used = 'Y' AND type='1' AND substr(use_date,1,10)='".substr($phi_daily_data[regdate],0,10)."'";
		list($phi_daily_coupon_used_count) = mysqli_fetch_array(mysqli_query($my_db, $phi_daily_coupon_used_count_query));
		$phi_daily_coupon_used_count_sum += $phi_daily_coupon_used_count;
?>
              <tr><td><?php echo substr($phi_daily_data[regdate],0,10)?></td><td><?php echo $phi_daily_coupon_used_count?></td></tr>
<?php
	}
?>
              <tr><td>합계</td><td><?php echo $phi_daily_coupon_used_count_sum?></td></tr>
            </tbody>
          </table>
        </div>
		<!-- 대만 -->
        <div id="daily_coupon_used_count_div2" style="display:none">
          <table class="table table-hover">
            <thead>
              <tr><th colspan="2">Taiwan</th></tr>
              <tr><th>날짜</th><th>Total</th></tr>
            </thead>
            <tbody>
<?php
$daily_date_query = "SELECT regdate FROM event_topgirl_main Group by substr(regdate,1,10)";
$tai_daily_coupon_used_count_sum = 0;
$tai_res = mysqli_query($my_db, $daily_date_query);
	while($tai_daily_data = mysqli_fetch_array($tai_res))
	{
		$tai_daily_coupon_used_count_query = "SELECT count(*) FROM event_topgirl_prize_url WHERE used = 'Y' AND type='2' AND substr(use_date,1,10)='".substr($tai_daily_data[regdate],0,10)."'";
		list($tai_daily_coupon_used_count) = mysqli_fetch_array(mysqli_query($my_db, $tai_daily_coupon_used_count_query));
		$tai_daily_coupon_used_count_sum += $tai_daily_coupon_used_count;
?>
              <tr><td><?php echo substr($tai_daily_data[regdate],0,10)?></td><td><?php echo $tai_daily_coupon_used_count?></td></tr>
<?php
	}
?>
              <tr><td>합계</td><td><?php echo $tai_daily_coupon_used_count_sum?></td></tr>
            </tbody>
          </table>
        </div>
		<!-- 인도네시아 -->
        <div id="daily_coupon_used_count_div3" style="display:none">
          <table class="table table-hover">
            <thead>
              <tr><th colspan="2">Indonesia</th></tr>
              <tr><th>날짜</th><th>Total</th></tr>
            </thead>
            <tbody>
<?php
$daily_date_query = "SELECT regdate FROM event_topgirl_main Group by substr(regdate,1,10)";
$ind_daily_coupon_used_count_sum = 0;
$ind_res = mysqli_query($my_db, $daily_date_query);
	while($ind_daily_data = mysqli_fetch_array($ind_res))
	{
		$ind_daily_coupon_used_count_query = "SELECT count(*) FROM event_topgirl_prize_url WHERE used = 'Y' AND type='3' AND substr(use_date,1,10)='".substr($ind_daily_data[regdate],0,10)."'";
		list($ind_daily_coupon_used_count) = mysqli_fetch_array(mysqli_query($my_db, $ind_daily_coupon_used_count_query));
		$ind_daily_coupon_used_count_sum += $ind_daily_coupon_used_count;
?>
              <tr><td><?php echo substr($ind_daily_data[regdate],0,10)?></td><td><?php echo $ind_daily_coupon_used_count?></td></tr>
<?php
	}
?>
              <tr><td>합계</td><td><?php echo $ind_daily_coupon_used_count_sum?></td></tr>
            </tbody>
          </table>
        </div>
        <!-- 싱가폴 -->
        <div id="daily_coupon_used_count_div4" style="display:none">
          <table class="table table-hover">
            <thead>
              <tr><th colspan="2">Singapore</th></tr>
              <tr><th>날짜</th><th>Total</th></tr>
            </thead>
            <tbody>
<?php
$daily_date_query = "SELECT regdate FROM event_topgirl_main Group by substr(regdate,1,10)";
$sin_daily_coupon_used_count_sum = 0;
$sin_res = mysqli_query($my_db, $daily_date_query);
	while($sin_daily_data = mysqli_fetch_array($sin_res))
	{
		$sin_daily_coupon_used_count_query = "SELECT count(*) FROM event_topgirl_prize_url WHERE used = 'Y' AND type='4' AND substr(use_date,1,10)='".substr($sin_daily_data[regdate],0,10)."'";
		list($sin_daily_coupon_used_count) = mysqli_fetch_array(mysqli_query($my_db, $sin_daily_coupon_used_count_query));
		$sin_daily_coupon_used_count_sum += $sin_daily_coupon_used_count;
?>
              <tr><td><?php echo substr($sin_daily_data[regdate],0,10)?></td><td><?php echo $sin_daily_coupon_used_count?></td></tr>
<?php
	}
?>
              <tr><td>합계</td><td><?php echo $sin_daily_coupon_used_count_sum?></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- jQuery Version 1.11.0 -->
<script src="js/jquery-1.11.0.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>




<script type="text/javascript">
	function display_daily_count(val)
	{
		for(i=1; i<=4; i++) {
			if(i == val) {
				document.getElementById('daily_count_main' + i).style.display = "block";  
			} else {
				document.getElementById('daily_count_main' + i).style.display = "none";  
			}
		}
	}

	function display_daily_applicant_count(val)
	{
		for(i=1; i<=4; i++) {
			if(i == val) {
				document.getElementById('daily_applicant_count_div' + i).style.display = "block";  
			} else {
				document.getElementById('daily_applicant_count_div' + i).style.display = "none";  
			}
		}
	}

	function display_daily_topgirl_vote_count(val)
	{
		for(i=1; i<=4; i++) {
			if(i == val) {
				document.getElementById('daily_topgirl_vote_count_div' + i).style.display = "block";  
			} else {
				document.getElementById('daily_topgirl_vote_count_div' + i).style.display = "none";  
			}
		}
	}
	
	function display_daily_story_vote_count(val)
	{
		for(i=1; i<=4; i++) {
			if(i == val) {
				document.getElementById('daily_story_vote_count_div' + i).style.display = "block";  
			} else {
				document.getElementById('daily_story_vote_count_div' + i).style.display = "none";  
			}
		}
	}

	function display_daily_coupon_used_count(val)
	{
		for(i=1; i<=4; i++) {
			if(i == val) {
				document.getElementById('daily_coupon_used_count_div' + i).style.display = "block";  
			} else {
				document.getElementById('daily_coupon_used_count_div' + i).style.display = "none";  
			}
		}
	}

</script>