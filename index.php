<?php 
} 
?> 

3、如何实现分页，包括两个函数，两个调用 
1）两个函数 
<? 
//分页函数 
function genpage(&$sql,$page_size=2) 
{ 
global $prepage,$nextpage,$pages,$sums; //out param 
$page = $_GET["page"]; 
$eachpage = $page_size; 
$pagesql = strstr($sql," from "); 
$pagesql = "select count(*) as ids ".$pagesql; 
$conn = mysql_query($pagesql) or die(mysql_error()); 
if($rs = mysql_fetch_array($conn)) $sums = $rs[0]; 
$pages = ceil(($sums-0.5)/$eachpage)-1; 
$pages = $pages>=0?$pages:0; 
$prepage = ($page>0)?$page-1:0; 
$nextpage = ($page<$pages)?$page+1:$pages; 
$startpos = $page*$eachpage; 
$sql .=" limit $startpos,$eachpage "; 
} 
// 显示分页 
function showpage() 
{ 
global $page,$pages,$prepage,$nextpage,$queryString; //param from genpage function 
$shownum =10/2; 
$startpage = ($page>=$shownum)?$page-$shownum:0; 
$endpage = ($page+$shownum<=$pages)?$page+$shownum:$pages; 

echo "共".($pages+1)."页: "; 
if($page>0)echo "<a href=$PHP_SELF?page=0$queryString>首页</a>"; 
if($startpage>0) 
echo " ... <b><a href=$PHP_SELF?page=".($page-$shownum*2)."$queryString>?</a></b>"; 
for($i=$startpage;$i<=$endpage;$i++) 
{ 
if($i==$page) echo " <b>[".($i+1)."]</b> "; 
else echo " <a href=$PHP_SELF?page=$i$queryString>".($i+1)."</a> "; 
} 
if($endpage<$pages) 
echo "<b><a href=$PHP_SELF?page=".($page+$shownum*2)."$queryString>?</a></b> ... "; 
if($page<$pages) 
echo "<a href=$PHP_SELF?page=$pages$queryString>尾页</a>"; 
} 
//显示带分类的分页 
function showpage1() 
{ 
$fenlei=$_GET["fenleiid"]; 
global $page,$pages,$prepage,$nextpage,$queryString; //param from genpage function 
$shownum =10/2; 
$startpage = ($page>=$shownum)?$page-$shownum:0; 
$endpage = ($page+$shownum<=$pages)?$page+$shownum:$pages; 

echo "共".($pages+1)."页: "; 
if($page>0)echo "<a href=$PHP_SELF?fenleiid=$fenlei&page=0$queryString>首页</a>"; 
if($startpage>0) 
echo " ... <b><a href=$PHP_SELF?fenleiid=$fenlei&page=".($page-$shownum*2)."$queryString>?</a></b>"; 
for($i=$startpage;$i<=$endpage;$i++) 
{ 
if($i==$page) echo " <b>[".($i+1)."]</b> "; 
else echo " <a href=$PHP_SELF?fenleiid=$fenlei&page=$i$queryString>".($i+1)."</a> "; 
} 
if($endpage<$pages) 
echo "<b><a href=$PHP_SELF?fenleiid=$fenlei&page=".($page+$shownum*2)."$queryString>?</a></b> ... "; 
if($page<$pages) 
echo "<a href=$PHP_SELF?fenleiid=$fenlei&page=$pages$queryString>尾页</a& amp; gt;"; 
} 
?> 
