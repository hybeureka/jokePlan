<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
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
	
	function generatePageLine($currentPageIndex, $totalPage, $pageUrl, $showCount) {
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
			for(  $i = $startPage ; $i < ($startPage+$showCount); $i++ ) {
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
			if( $totalPage - ($startPage+$showCount) >= 3 ) {
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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>快乐发源地-笑话,最新笑话,热门笑话,爆笑笑话,冷笑话,短笑话,经典笑话,幽默笑话,笑话大全</title>
		<meta name="description" content="快乐发源地笑话网是最专业的笑话网站,是集笑话,最新笑话,搞笑图片,热门笑话,爆笑笑话,冷笑话,短笑话,经典笑话,幽默笑话,搞笑视频等笑话内容于一体的笑话大全"/>
		<meta name="keywords" content="笑话,爆笑笑话,幽默笑话,幽默趣事,笑话大全,搞笑图片,快乐发源地"/>
  

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/page.css"/>
<script src="js/jquery-1.6.min.js" type="text/javascript"></script><style type="text/css"></style>
<script src="js/commons.js" type="text/javascript"></script>
<script src="js/cookie.js" type="text/javascript"></script>
<script src="js/Validator.js" type="text/javascript"></script>
	</head>
	<body id="nv_forum" class="pg_forumdisplay">
	<iframe frameborder="0" style="display: none;"></iframe>
	<div id="bdshare_s" style="display: block;">
	<iframe id="bdsIfr" style="position: absolute; display: none; z-index: 9999; top: 205px; left: 839.5px; height: 330px; width: 132px;" frameborder="0"></iframe>
	<div id="bdshare_m" style="display: none; left: 839.5px; top: 205px;"><div id="bdshare_m_c">
	<h6>分享到</h6><ul><li><a href="http://www.klfyd.com/#" class="bds_mshare mshare">一键分享</a></li>
	<li><a href="http://www.klfyd.com/#" class="bds_qzone qqkj">QQ空间</a></li>
	<li><a href="http://www.klfyd.com/#" class="bds_tsina xlwb">新浪微博</a></li>
	<li><a href="http://www.klfyd.com/#" class="bds_bdysc bdysc">百度云收藏</a></li>
	<li><a href="http://www.klfyd.com/#" class="bds_renren rrw">人人网</a></li>
	<li><a href="http://www.klfyd.com/#" class="bds_tqq txwb">腾讯微博</a></li>
	<li><a href="http://www.klfyd.com/#" class="bds_bdxc bdxc">百度相册</a></li>
	<li><a href="http://www.klfyd.com/#" class="bds_more">更多...</a></li>
	</ul><p><a href="http://www.klfyd.com/#" class="goWebsite">百度分享</a></p>
	</div></div></div><div class="floatbar" id="floatbar"><a href="javascript:;" title="收藏" class="quick" id="quick">收藏</a>
	<a href="javascript:;" class="suggest">Top</a><a href="javascript:;" title="回顶部" class="toplink" id="toplink">回顶部</a></div>
		<div id="append_parent"></div>
			
	<div id="toptb" class="cl">
			<div class="wp">
				<div class="z">
					<a href="javascript:setHomePage('http://www.klfyd.com/');" >设为首页</a>
					<a href="javascript:addFavorite('http://www.klfyd.com/', '快乐发源地');return false;">收藏本站</a>
					&nbsp;&nbsp;&nbsp;&nbsp;快乐发源地--汇集互联网精彩幽默笑话、搞笑视频与您分享！让你开心每一刻！（www.klfyd.com）
				</div>
				<div class="y">
				</div>
			</div>
		</div>
		<div id="v2-wpc" class="v2-bg49">
		
<!-- ### -->
<input type="hidden" name="quickurl" id="quickurl" value="当前页面路径"/>
	<div class="v2-headerc">
				<div class="v2-menu">
					<div class="v2-logo">
<a href="http://www.klfyd.com" title="快乐发源地"><img src="./image/logo.jpg" style="height:70px;" alt="快乐发源地" border="0"/> </a>
					</div>
					<div id="nv">
						<ul>
							<li id="nav_1" class="a"> <a onclick="setMenu(1);" href="http://www.klfyd.com/new/index.html">最新笑话</a> </li>
							<li id="nav_2"> <a onclick="setMenu(2);" href="http://www.klfyd.com/text/index.html">文字笑话</a></li>
							<li id="nav_3"> <a onclick="setMenu(3);" href="http://www.klfyd.com/pic/index.html">搞笑图片</a></li>
							<li id="nav_5"> <a onclick="setMenu(5);" href="http://www.klfyd.com/tag/index.html">热门标签</a> </li>
						</ul>
					</div>
					<!-- 
					<script type="text/javascript">
						initMenu();
					</script>
					 -->
					<div id="scbar" class="cl">
						<form action="http://www.klfyd.com/search/index.html" method="post" style="margin: 0px;">
							<div class="scbar_tt">
									<input type="text" name="keyword" value="" id="scbar_txt" class="xg1" placeholder="请输入搜索内容" autocomplete="off"/>
							</div>
							<div class="scbar_tp">
							</div>
							<div class="scbar_bn">
								<button type="submit" name="searchsubmit" id="scbar_btn" value="true">
									<strong>搜索</strong>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="v2-headerb1"></div>
			<div class="v2-headerb2"></div>
			<div class="v2-top">
				<div class="v2-headert"></div>
				<div class="v2-headerb1"></div>
				<div class="v2-headerb2"></div>
			</div>

		<div id="hd"></div>
			<!-- 中间开始 -->
			<div class="v2-wpbk">
				<div class="v2-wp">
					<div class="wp" id="wp">
						<div class="v2-bl">
							<div class="v2-boxtl"></div>
							<div class="v2-boxbk">
								<div class="v2-box">
									<div class="v2-wdpost">
										<ul>
										<?php
											$pageCount = 40;
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
										<?php
											while($row = mysql_fetch_array($result))
										  {
										  		$title = $row['title'];
										  		$id = $row['id'];
										  		$content = $row['content']
										  		
										?>
											<li>
												<div class="share">
													  <!-- Baidu Button BEGIN -->
													   		<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare" data="{							
															&#39;text&#39;:&#39;<?php echo $title . "---" . $content ."---快乐反应堆"?>&#39;,
															&#39;url&#39;:&#39;http://www.klfyd.com/jokeDetail.php?id=<?php echo $id?>&#39;
															}">
													        <span title="分享这个笑话" style="background:none !important;width:49px;height:51px;" class="bds_more"></span>
													    </div>
													<!-- Baidu Button END -->
												</div>
												<div class="v2-dtxt">
													<h1>
														<a href="http://www.klfyd.com/jokeDetail.php?id=<?php echo $id ?>"><?php echo $title ?></a>
													</h1>
													<p>
														<?php echo $content ?>
													</p>
													<p class="v2-wdpnm">
					                                      	 标签：
					                                      	 	 <a href="http://www.klfyd.com/tag/list-%E5%B9%BD%E9%BB%98%E8%B6%A3%E4%BA%8B.html">幽默趣事</a>
					                                      	 	 <a href="http://www.klfyd.com/tag/list-%E5%86%85%E6%B6%B5.html">内涵</a>
													</p>
												</div>
											</li>
										<?php
										  }
										?>	
												<div style="font-size:12px;float:left;width:98%;align:right;" align="right" class="pagination">
											  		<?php $pageLine = generatePageLine($pageIndex,$totalPage,'index.php?x=1',10);	
														echo $pageLine;
													?>
											  </div>
										</ul>
									</div>

								</div>
							</div>
							<div class="v2-boxbl"></div>
						</div>
						
<!--cnzz tui
<script  type="text/javascript" charset="utf-8"  src="http://tui.cnzz.net/cs.php?id=1000032019"></script>-->
<!--cnzz tui-->
	<div class="v2-br">
	 
	     <div class="v2-boxtr"></div>
    <div class="v2-boxbk">
		<div class="v2-box">
			<h2>
				热门标签
			</h2>
			<div class="v2-tag">
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E9%9B%95%E5%A1%91.html">雕塑</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E8%B6%85%E5%B8%82.html">超市</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E9%87%8D%E5%8F%A3%E5%91%B3.html">重口味</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E7%88%B1%E6%83%85.html">爱情</a>
									<a class="tag_level1" href="http://www.klfyd.com/tag/list-%E7%94%B5%E8%AF%9D.html">电话</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E7%9F%AD%E4%BF%A1.html">短信</a>
									<a class="tag_level1" href="http://www.klfyd.com/tag/list-%E8%8B%B1%E8%AF%AD.html">英语</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E7%94%B5%E8%A7%86.html">电视</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E6%89%8B%E6%9C%BA.html">手机</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E9%82%AA%E6%81%B6.html">邪恶</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E9%A3%9E%E6%9C%BA.html">飞机</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E8%81%8A%E5%A4%A9.html">聊天</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E7%85%A7%E7%89%87.html">照片</a>
									<a class="tag_level1" href="http://www.klfyd.com/tag/list-2B.html">2B</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E5%8A%A8%E6%80%81%E5%9B%BE.html">动态图</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E9%9C%B8%E6%B0%94.html">霸气</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E5%86%9B%E4%BA%8B.html">军事</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E5%86%B7%E7%AC%91%E8%AF%9D.html">冷笑话</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E5%8D%96%E8%90%8C.html">卖萌</a>
									<a class="tag_level1" href="http://www.klfyd.com/tag/list-%E7%94%B5%E5%BD%B1.html">电影</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E8%A1%A8%E6%83%85.html">表情</a>
									<a class="tag_level1" href="http://www.klfyd.com/tag/list-%E8%90%9D%E5%8D%9C.html">萝卜</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E9%A3%9F%E5%A0%82.html">食堂</a>
									<a class="tag_level1" href="http://www.klfyd.com/tag/list-%E5%B0%8F%E9%B8%9F.html">小鸟</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E7%BD%91%E7%BB%9C.html">网络</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E5%AE%BF%E8%88%8D.html">宿舍</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E5%B1%B1%E5%AF%A8.html">山寨</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E6%98%8E%E6%98%9F.html">明星</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-%E5%8E%95%E6%89%80.html">厕所</a>
									<a class="tag_level2" href="http://www.klfyd.com/tag/list-QQ.html">QQ</a>
				 <a href="http://www.klfyd.com/tag/index.html">更多</a>
			</div>
		</div>
	</div>
    <div class="v2-boxbrj"></div>
    <div class="v2-boxtr"></div>
    <div class="v2-boxbk">
		<div class="v2-box">
			<div class="v2-tag">
    <!-- 
					 <script type="text/javascript"><!--
							google_ad_client = "ca-pub-3018430189165622";
							/* 250-250 */
							google_ad_slot = "8615258889";
							google_ad_width = 250;
							google_ad_height = 250;
							
							</script>
							<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
     -->
			</div>
		</div>
	</div>
    <div class="v2-boxbrj"></div>
    <!-- 
    <div class="v2-boxtr"></div>
    <div class="v2-boxbk">
		<div class="v2-box">
			<script  type="text/javascript" charset="utf-8"  src="http://tui.cnzz.net/cs.php?id=1000039722"></script>
		</div>
	</div>
    <div class="v2-boxbrj"></div> 
    -->
    <div class="v2-boxtr"></div>
    <div class="v2-boxbk">
		<div class="v2-box">
			<h2>
				友情链接
			</h2>
			<div class="v2-tag">
				<a href="http://www.klfyd.com">爆笑笑话</a>
				<a href="http://www.klfyd.com">笑话大全</a>
				<a href="http://www.klfyd.com">幽默笑话</a>
				<a href="http://www.klfyd.com">快乐发源地</a>
				<a href="http://www.klfyd.com/text/index.html">小笑话集锦</a>
			</div>
		</div>
	</div>
    <div class="v2-boxbrj"></div>
</div>
						<div class="cl"></div>
					</div>
				</div>
			</div>
			<!-- 中间结束 -->
		</div>
		<!-- 底部内容 -->
		
	 <div class="v2-ft">
			<div id="ft">
				<div class="wp cl">
					<div id="frt">
						<p class="v2-fmu">
							<a target="_blank" href="http://www.klfyd.com/new/index.html">最新笑话</a>
							<span class="pipe">|</span>
							<a href="http://www.klfyd.com/text/index.html">文字笑话</a>
							<span class="pipe">|</span>
							<a href="http://www.klfyd.com/pic/index.html">搞笑图片</a>
							<span class="pipe">|</span>
							<a href="http://www.klfyd.com/tag/index.html">热门笑点</a>
						</p>
						<!-- 
						<p class="v2-fmu1">
							Copyright © 2013 - 2013
							<a target="_blank" href="./快乐发源地-笑话,最新笑话,热门笑话,爆笑笑话,冷笑话,短笑话,经典笑话,幽默笑话,笑话大全_files/快乐发源地-笑话,最新笑话,热门笑话,爆笑笑话,冷笑话,短笑话,经典笑话,幽默笑话,笑话大全.htm">快乐发源地</a> 
							(<a target="_blank" rel="nofollow" href="http://www.miitbeian.gov.cn/">粤ICP备13020251号</a>)
							All rights reserved.
							<script src="./快乐发源地-笑话,最新笑话,热门笑话,爆笑笑话,冷笑话,短笑话,经典笑话,幽默笑话,笑话大全_files/stat.php" language="JavaScript"></script><script src="./快乐发源地-笑话,最新笑话,热门笑话,爆笑笑话,冷笑话,短笑话,经典笑话,幽默笑话,笑话大全_files/core.php" charset="utf-8" type="text/javascript"></script><a href="http://www.cnzz.com/stat/website.php?web_id=5206127" target="_blank" title="站长统计"><img border="0" hspace="0" vspace="0" src="image/pic1.gif"></a>
							<a target="_blank" href="http://www.klfyd.com/sitemap.xml">网站地图</a> 
						</p>
						 -->
					</div>
				</div>
			</div>
		</div>

		<!-- 底部内容 -->
		<script type="text/javascript" id="bdshare_js" data="type=tools&amp;mini=1" src="js/bds_s_v2.js"></script> 
		 
		<script type="text/javascript">
				document.getElementById('bdshell_js').src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
		</script>
	
</body></html>