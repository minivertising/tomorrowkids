<?php

include_once "./include/page.class.php";
include_once "./include/db_conn.php";
include "./head.php";

$search_type = $_REQUEST['search_type'];
$search_txt = $_REQUEST['search_txt'];
$pg = $_REQUEST['pg'];

if(!$pg) $pg = 1;	// $pg가 없으면 1로 생성
$page_size = 20;	// 한 페이지에 나타날 개수
$block_size = 10;	// 한 화면에 나타낼 페이지 번호 개수

$applicant_count_main = '1';
$topgirl_vote_count_main = '2';
$story_vote_count_main = '3';

$code_philippines = '1';
$code_taiwan = '2';
$code_indonesia = '3';
$code_singapore = '4';

if (!$search_type)
	$search_type = "search_by_name";
?>

<div id="page-wrapper">
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">탑걸 응모자 목록</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <ol class="breadcrumb">
          <form name="frm_execute" method="POST">
            <input type="hidden" name="pg">
            <select name="search_type">
              <option value="search_by_name" <?php if($search_type == "search_by_name"){?>selected<?php }?>>이름</option>
              <option value="search_by_phone" <?php if($search_type == "search_by_phone"){?>selected<?php }?>>전화번호</option>
              <option value="search_by_country" <?php if($search_type == "search_by_country"){?>selected<?php }?>>국가</option>
            </select>
            <input type="text" name="search_txt" onkeyup="search_query(this.value,search_type.value)" value="<?php echo $search_txt?>">
          </form>
          </ol>

          <table id="applicant_list" class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>이름</th>
                <th>나이</th>
                <th>전화번호</th>
                <th>이메일</th>
                <th>국가</th>
                <th>주소</th>
                <th>YOUTUBE URL</th>
                <th>LIKE COUNT</th>
                <th>신청날짜</th>
                <th>쿠폰 URL</th>
                <th>쿠폰 사용여부</th>
              </tr>
            </thead>
            <tbody>
<?php 

$applicant_list_count_query = "SELECT count(*) FROM event_topgirl_main";
list($applicant_list_count) = mysqli_fetch_array(mysqli_query($my_db, $applicant_list_count_query));

$PAGE_CLASS = new Page($pg,$applicant_list_count,$page_size,$block_size);
$BLOCK_LIST = $PAGE_CLASS->blockList(); 
$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;


$applicant_list_query = "SELECT intseq, strNAME, strAGE, PHONE, EMAIL, ADDRESS , YOUTUBE, TYPE, LIKECOUNT, USERID, REGDATE, coupon_page, USED FROM event_topgirl_main Order by intseq DESC LIMIT $PAGE_CLASS->page_start, $page_size";
$res = mysqli_query($my_db, $applicant_list_query);

	while($applicant_data = mysqli_fetch_array($res))
	{
		if($applicant_data[TYPE]=="1"){
			$country = "필리핀";
		}else if($applicant_data[TYPE]=="2"){
			$country = "대만";
		}else if($applicant_data[TYPE]=="3"){
			$country = "인도네시아";
		}else if($applicant_data[TYPE]=="4"){
			$country = "싱가폴";
		}
?>
              <tr>
                <td><?php echo $PAGE_UNCOUNT--?></td>	<!-- No. 하나씩 감소 -->
                <td><?php echo $applicant_data[strNAME]?></td>
                <td><?php echo $applicant_data[strAGE]?></td>
                <td><?php echo $applicant_data[PHONE]?></td>
                <td><?php echo $applicant_data[EMAIL]?></td>
                <td><?php echo $country?></td>
                <td><?php echo $applicant_data[ADDRESS]?></td>
                <td><?php echo $applicant_data[YOUTUBE]?></td>
                <td><?php echo $applicant_data[LIKECOUNT]?></td>
                <td><?php echo $applicant_data[REGDATE]?></td>
                <td><?php echo $applicant_data[coupon_page]?></td>
<?php
if($applicant_data[USED]=="1"){
	$coupon_status = "사용완료";
}else if($applicant_data[USED]=="0"){
	$coupon_status = "미사용";
}
?>
						<td><?php echo $coupon_status?></td>
						</tr>
<?php 
	}
?>
              <tr><td colspan="12"><div class="pageing"><?php echo $BLOCK_LIST?></div></td></tr>
            </tbody>
          </table>
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
 
	function pageRun(num)
	{
		f = document.frm_execute;
		f.pg.value = num;
		f.submit();
	}

	// 검색어 서칭 ajax 처리
	function search_query(val1,val2)
	{
		$.ajax({
			type	: "POST",
			url		: "ajax_applicant_list.php",
			data	: ({
						"search_txt"	: val1,
						"search_type"	: val2
					}),
			success	: function(msg) {
				$("#applicant_list").html(msg);
			}
		});
	}


</script>