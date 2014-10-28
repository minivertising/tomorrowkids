<?
	// 설정파일
	include_once "../config.php";
	include_once "header.php";

	// 주소 바로 입력시 index로 이동
	if ( !isset($_SERVER['HTTP_REFERER']) ) { 
		header('Location: index.php'); 
		exit; 
	} 
	$t_count1 = substr($total_count,0,1);
	$t_count2 = substr($total_count,0,2);
	$t_count3 = substr($total_count,0,3);
	$t_count4 = substr($total_count,0,4);
?>
<script>
    window.history.forward(0);
</script>

<body>
<div class="mob_sub_top1">
	<h1><a href=""><img src="images/logo.png"/></a></h1>
    <div>
    	<div class="tmor_text fl_left"><img src="images/page_title.png"/></div>
        <div class="mob_sub_number fl_right">
        	<div class="peopletitle">현재 참여자</div>
            <div class="numberbox">
            	<ul>
                    <li><?=$t_count1?></li>
                    <li class="number2"><?=$t_count2?></li>
                    <li class="number3"><?=$t_count3?></li>
                    <li class="number4"><?=$t_count4?></li>
           		</ul>
            </div>
        </div>
    </div>
</div>
<div class="mob_sub_top2">
	<p class="blue">STEP 1</p>
    <p class="white">내일 (Work) 테스트</p>
    <div class="white1">당신의 내일(work)을 확인하기 위한 10개의 질문에
답해주세요. 직감에 의존하는 대답을 해 주실수록 
상상 이상의 특별한 일들이 기다리고 있답니다!
</div>
	<div class="top2_content">
    	<div class="quas">
        	5. 갑자기 생각지 않은 일주일의 휴가가 생겼다.       
    당신이 하고 싶은 것은? 
        </div>
        <div class="ansbox">
        	<div class="fl_left tag">A.</div>
            <div class="fl_left tagtext">오랜만에 여유 있는 나만의 시간을 갖고 싶다.  
집에서 푹 쉬거나 못 만났던 친구들을 만난다. 
대낮의 여유도 즐긴다</div>
        </div>
         <div class="ansbox">
        	<div class="fl_left tag">B.</div>
            <div class="fl_left tagtext2">이런 기회가 또 오겠는가. 당장 가장 빠른 
비행기와 숙박 편을 확인해서    가까운 해외로
떠난다.  휴가 바로 전날까지 실컷 놀다 온다. 
대낮의 여유도 즐긴다</div>
        </div>
        <div class="next_but"><a href=""><img src="images/next_qu_but.jpg"/></a></div>
    </div>
    <div class="footer_mob">
	<div class="line1">
    	<p>이 캠페인은 온라인 나눔문화 확산을 위한 한국타이어의</p>
        <span class="hankologo">기부후원으로 진행됩니다.</span>
    </div>
    <div class="line2">
    	<div class="logoline"><img src="images/line2_logo.png"/></div>
        <div class="textline2">부스러기사랑나눔회 소개 | 이용약관 | 개인정보처리방침 | 기부정책 | <br/>
본 사이트는 [㈜엠프론티어]의 재능기부로 제작되었습니다.<br/>
사단법인 부스러기사랑나눔회 / 대표자 : 강명순 / 사업자번호 : 110-82-08381 <br/>
서울시 용산구 청파로 46 한통빌딩 10층 / 문의 : 070-7164-7215/7209<br/>
/ 카카오톡 ID : @드림풀
        </div>
    </div>
</div>
</div>
</body>
</html>
