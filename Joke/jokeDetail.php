<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
<?php
if( empty($_GET["id"]) || !isset($_GET['id']) ) {
	?>
	<script type="text/javascript">
		document.history.back(-1);
	</script>
	<?php
} else {
	$id = $_GET["id"];
}
$con = mysql_connect("localhost","root","eureka");
if (!$con) {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("joke", $con);

$result = mysql_query("SELECT * FROM joke where id=$id");
?>
<?php
if($row = mysql_fetch_array($result))
  {
?>
<title><?php  echo $row['title']."---"; echo "快乐发源地,笑话,搞笑,囧事,可笑的,哈哈大笑,可笑,有趣,搞笑段子,段子"; ?></title>
    <meta http-equiv="快乐发源地,笑话,搞笑,囧事,可笑的,哈哈大笑,可笑,有趣,搞笑段子,段子" content="<?php echo "快乐发源地,笑话,搞笑,囧事,可笑的,哈哈大笑,可笑,有趣,搞笑段子,段子"; ?>">
    <meta http-equiv="description" content="快乐发源地,笑话,搞笑,囧事,可笑的,哈哈大笑,可笑,有趣,搞笑段子,段子">
	<link rel="stylesheet" type="text/css" href="css/common.css" >
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/jquery-1.6.min.js"></script>
  </head>
<body style="background-color:#ece5d8">
<?php include 'head.html';?>
<div style="background-color:#ece5d8">


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
<?php include 'foot.html'?>
</body>
</html>