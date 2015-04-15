<?php
try{
if(isset($_GET['delete']))
{
	//必须是本站的删除请求
	$host = $_SERVER['SERVER_NAME'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if(isset($_GET['pk']) && $ref['host'] == $host && $_GET['delete']=='hardware')
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/disk/'.$_GET['pk'], 'delete');
	}
}
$search = $_GET['search']?$_GET['search']:'';

$statu_hardware = httpRequest('http://api.icdn.me:8000/node/u/hardware/'.$search);
$statu_hardware= json_decode($statu_hardware, true);
$statu_hardware = is_array($statu_hardware[0])?$statu_hardware:array($statu_hardware);
}catch (Exception  $e)
{
	echo '网络连接错误';
	exit;
}
?>
<script>
$(function(){
	$("#btn").bind("click",function(){
		window.location.reload();
	})
})
</script>
<div class="mwin" id="page">
    <div class="hd radius5tr clearfix">
            <h3>状态信息</h3>
    </div>
    <div>
		<input type="button" class="btn" id='btn' value="刷新" />
		<form action="" method='GET' style="text-align: right">
		<input type="hidden" name="view" value="node_hard"/>
		<input type="text" placeholder="搜索Pk" name='search'/>
		<input type="submit" value='search'/>
		</form>
		<b style="font-size: 15px">hard_ware状态信息：</b>
	    <div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>node_name</td>
			 	 <td class='title'>pk</td>
				 <td class='title'>cpu</td>
				 <td class='title'>phymem</td>
				 <td class='title'>swapmem</td>
				 <td class='title'>disk</td>

				 <td class='title'>操作</td>
			 </tr>
			 <?php
			 	foreach ($statu_hardware as $hardware)
			 	{
			 ?>
			 <tr>
			 	 <td ><?php echo $hardware['node_name'];?></td>
				 <td ><?php echo $hardware['pk'];?></td>
				 <td ><?php echo $hardware['cpu'];?></td>
				 <td ><?php echo $hardware['phymem'];?></td>
				 <td ><?php echo $hardware['swapmem'];?></td>
				 <td ><?php echo $hardware['disk'];?></td>
				 <td><a href="demo.php?delete=hardware&pk=<?php echo $hardware['pk']; ?>">删除</a></td>
			 </tr>
			 <?php
			 	}
			 ?>
		</table>
		</div>