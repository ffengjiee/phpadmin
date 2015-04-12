<?php
try{
if(isset($_GET['delete']))
{
	//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if(isset($_GET['pk']) && $ref['host'] == $host && $_GET['delete']=='disk')
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/disk/'.$_GET['pk'], 'delete');
	}

}
$search = $_GET['search']?$_GET['search']:'';


$statu_disks = httpRequest('http://api.icdn.me:8000/node/u/disk/'.$search);
$statu_disks= json_decode($statu_disks, true);
$statu_disks = is_array($statu_disks[0])?$statu_disks:array($statu_disks);

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
		<input type="hidden" name="view" value="node_disk"/>
		<input type="text" placeholder="搜索Pk" name='search'/>
		<input type="submit" value='search'/>
		</form>
		<b style="font-size: 15px">disk状态信息：</b>
	    <div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>node_name</td>
			 	 <td class='title'>pk</td>
				 <td class='title'>path</td>
				 <td class='title'>total</td>
				 <td class='title'>used</td>
				 <td class='title'>rest</td>
				 <td class='title'>percent</td>
				 <td class='title'>node</td>
				 
				 <td class='title'>操作</td>
			 </tr>
			 <?php 
			 	foreach ($statu_disks as $status_disk)
			 	{
			 ?>
			 <tr>
			 	 <td ><?php echo $status_disk['node_name'];?></td>
				 <td ><?php echo $status_disk['pk'];?></td>
				 <td ><?php echo $status_disk['path'];?></td>
				 <td ><?php echo $status_disk['total'];?></td>
				 <td ><?php echo $status_disk['used'];?></td>
				 <td ><?php echo $status_disk['rest'];?></td>
				 <td> <?php echo $status_disk['percent'];?></td>
				 <td ><?php echo $status_disk['node'];?></td>
				 <td><a href="demo.php?delete=disk&pk=<?php echo $status_disk['pk']; ?>">删除</a></td>
			 </tr>
			 <?php 
			 	}
			 ?>
		</table>
		</div>