<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
	function generatePageLine($currentPageIndex, $totalPage, $pageUrl) {
		$result = "";
		$space = "&nbsp;";
		$showPageIndex = $currentPageIndex + 1;
		//var_dump($showPageIndex);
		if( $totalPage > 1 ) {
			if( $currentPageIndex != 0  && $totalPage >= 2 ) {
				$result .= "<a href='". $pageUrl . "&pageIndex=" . 0 . "'>首页</a>";
			}
			$startPage = $currentPageIndex - 3;
			if( $startPage < 0 ) {
				$startPage = 0;
			}
			if( $currentPageIndex != 0 ) {
				$result .= "<a href='" . $pageUrl . "&pageIndex=" . ($currentPageIndex - 1) . "'>上一页</a>";
			}
			for(  $i = $startPage ; $i < ($startPage+15); $i++ ) {
				$showPageIndex = $i + 1;
					if( $currentPageIndex == $i ) {
						$result .= $space;
						$result .= $showPageIndex;
						//var_dump($result);
					} else {
						if( $i <= $totalPage - 1 ) {
							$result .= $space;
							$result .= "<a href='" . $pageUrl . "&pageIndex=" . $i . "'>" . $showPageIndex . "</a>";
						}
					}
			}
			if( $totalPage - ($startPage+15) >= 3 ) {
				$result .= $space . "...";
				$result .= $space;
				$result .= "<a href='". $pageUrl . "&pageIndex=" . ($totalPage - 3) . "'>".($totalPage - 2)."</a>";
				$result .= $space;
				$result .= "<a href='". $pageUrl . "&pageIndex=" . ($totalPage - 2) . "'>".($totalPage - 1)."</a>";
				$result .= $space;
				$result .= "<a href='". $pageUrl . "&pageIndex=" . ($totalPage - 1) . "'>".$totalPage."</a>";
			}
			if( $currentPageIndex != $totalPage - 1 ) {
				$result .= "<a href='" . $pageUrl . "&pageIndex=" . ($currentPageIndex + 1) . "'>下一页</a>";
			}
			if( $totalPage >= 2 && $currentPageIndex != ($totalPage - 1)) {
				$result .= $space;
				$result .= "<a href='". $pageUrl . "&pageIndex=" . ($totalPage - 1) . "'>尾页</a>";
			}
		}
		return $result;
	}

	function calculateTotalPageCount($totalCount2, $countPerPage2) {
		$result = 0;
		if( $totalCount2 > 0 && $countPerPage2 > 0 ) {
			$moreOf = $totalCount2%$countPerPage2;
			$result = ($totalCount2-$moreOf)/$countPerPage2;
			if( $moreOf > 0 ) {
				$result += 1;
			}
		}
		return $result;
	}
?>
<?php
$pageCount = 20;
$pageIndex = 0;
if( empty($_GET["pageIndex"]) || !isset($_GET['pageIndex']) ) {
	$pageIndex = 0;
} else {
	$pageIndex = $_GET["pageIndex"];
}
$startIndex = $pageIndex*$pageCount;
$con = mysql_connect("localhost","root","eureka");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//mysql_query("set names gb2312");
mysql_select_db("joke", $con);

$result = mysql_query("SELECT * FROM joke limit $startIndex, $pageCount");
$result2 = mysql_query("select count(id) from joke");

$countR = mysql_fetch_array($result2);
$count = $countR[0];
$totalPage = calculateTotalPageCount($count,$pageCount);
$outPageIndex = $pageIndex + 1;
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
<title><?php echo "快乐发源地,笑话,搞笑,囧事,可笑的,哈哈大笑,可笑,有趣,搞笑段子,段子" ?></title>
    <meta http-equiv="快乐发源地,笑话,搞笑,囧事,可笑的,哈哈大笑,可笑,有趣,搞笑段子,段子,热门笑话,爆笑笑话,冷笑话,短笑话,经典笑话,幽默笑话" content="<?php echo "快乐发源地,笑话,搞笑,囧事,可笑的,哈哈大笑,可笑,有趣,搞笑段子,段子,热门笑话,爆笑笑话,冷笑话,短笑话,经典笑话,幽默笑话"; ?>">
    <meta http-equiv="description" content="快乐发源地,笑话,搞笑,囧事,可笑的,哈哈大笑,可笑,有趣,搞笑段子,段子,热门笑话,爆笑笑话,冷笑话,短笑话,经典笑话,幽默笑话">
	<link rel="stylesheet" type="text/css" href="css/common.css" >
	<link rel="stylesheet" type="text/css" href="css/page.css" >
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/jquery-1.6.min.js"></script>
  </head>
<body style="background-color:#ece5d8">
  <?php include 'head.html';?>
  <div style="background-color:#ece5d8">
<?php
while($row = mysql_fetch_array($result))
  {
?>


  <div style="width:62%;margin-left:6%;background-color:#FBFFFD;" class="shadow" onclick="javascript:location='jokeDetail.php?id=<?php echo $row['id']?>';">
  <br/>
  <div style="font-size:14px;" align="center" ><a class="titleLink" href="jokeDetail.php?id=<?php echo $row['id']?>"><?php echo $row['title']?>&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
  <br/>
  <div style="margin-left:5%;margin-right:5%;font-size:15px;"><?php echo $row['content']?></div>
  <br/>
  <div style="font-size:13px;margin-left:12%;" align="left"><?php echo $row['summary']?></div>
  <br/>
 
  <br/>
  </div>
  <div style="backgroung-color:#CECEFF;width:100%;">&nbsp;</div>
<?php
  }
?>
</div>
  <div align="right">
  <div style="font-size:12px;float:left;width:98%;align:right;" align="right" class="pagination">
  		<?php $pageLine = generatePageLine($pageIndex,$totalPage,'index.php?x=1');	
			echo $pageLine;
		?>
  </div>
  </div>
  <div style="left:70%;top:340px;width:28%;height:310px;position:absolute;background-color:yellow;">
  	<div style="margin-left:8px;margin-top:8px;width:95%;height:290px;background-color:white;">&nbsp;</div>
  </div>
  <br/>
  <div style="margin-left:6%;">
 <?php if( $pageIndex >= 1 )  {?>
  <button style="height:80px;width:160px;" onclick="javascript:location='index.php?pageIndex=<?php $forePageIndex = $pageIndex - 1; echo "$forePageIndex"?>'"><font size="16">上一页</font></button>
 <?php } else  { ?>
 <button style="height:80px;width:160px;disabled:true;" onclick="javascript:location='index.php?pageIndex=0'"><font size="16">首页</font></button>
 <?php }?>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" size="1" id="pageIndex" style="height:80px;width:100px;padding:0px;margin:0px;" /> <button style="height:80px;width:80px;" onclick="checkJump();"><font size="16">go</font></button>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if( $pageIndex < $totalPage - 1 )  {?>
  <button style="height:80px;width:160px;" onclick="javascript:location='index.php?pageIndex=<?php $afterPageIndex = $pageIndex + 1; echo "$afterPageIndex"?>'"><font size="16">下一页</font></button>
<?php } else { ?>
 <button style="height:80px;width:160px;disabled:true;" onclick="javascript:location='index.php?pageIndex=<?php echo $totalPage - 1 ?>'"><font size="16">尾页</font></button>
 <?php }?>
   </div>
   <script type="text/javascript">
	function checkJump() {
		var pi = document.getElementById("pageIndex").value;
		var pin = parseInt(pi);
		if( pin >= 1 && pin <= <?php echo $totalPage ?> ) {
			window.location='index.php?pageIndex='+ (pin - 1);
		}
	}
	
	jQuery(document).ready(function (){
		jQuery("*").keydown( function (){
				
                    if( event.which == 37 ) {
							<?php if( $pageIndex >= 1 ) { ?>
                            window.location='index.php?pageIndex=<?php $forePageIndex = $pageIndex - 1; echo "$forePageIndex"?>';
							<?php }?>
                   } else if( event.which == 39 ){
							<?php if( $pageIndex < $totalPage - 1 ) { ?>
							window.location='index.php?pageIndex=<?php $afterPageIndex = $pageIndex + 1; echo "$afterPageIndex"?>';
							<?php }?>
				   }
          });

	});

	
	
	function checkPageIndex(pin) {
		if( pin >= 1 && pin <= <?php echo $totalPage ?> ) {
			return true;
		} else {
			return false;
		}
	}
</script>
<?php include 'foot.html';?>
</body>

 <!-- 
  <div style="font-size:12px;margin-left:70%;width:160px;background-color:#D8D8D5;">$!{joke.dateString}</div>
   -->
<?php
mysql_close($con);
?>
</html>