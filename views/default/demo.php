<?php 
try{
if(isset($_GET['delete']))
{
	//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if(isset($_GET['pk']) && $ref['host'] == $host && $_GET['delete']=='info')
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/info/'.$_GET['pk'], 'delete');
	}
	if(isset($_GET['pk']) && $ref['host'] == $host && $_GET['delete']=='ip')
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/ip/'.$_GET['pk'], 'delete');
	}
	if(isset($_GET['pk']) && $ref['host'] == $host && $_GET['delete']=='disk')
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/disk/'.$_GET['pk'], 'delete');
	}
	if(isset($_GET['pk']) && $ref['host'] == $host && $_GET['delete']=='status')
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/disk/'.$_GET['pk'], 'delete');
	}
	if(isset($_GET['pk']) && $ref['host'] == $host && $_GET['delete']=='hardware')
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/disk/'.$_GET['pk'], 'delete');
	}
}
$search = $_GET['search']?$_GET['search']:'';
$status = httpRequest('http://api.icdn.me:8000/node/u/info/'.$search);
$status = json_decode($status, true);
$status = is_array($status[0])?$status:array($status);

$statu_ip = httpRequest('http://api.icdn.me:8000/node/u/ip/'.$search);
$status_ips= json_decode($statu_ip, true);
$status_ips = is_array($status_ips[0])?$status_ips:array($status_ips);

$statu_disks = httpRequest('http://api.icdn.me:8000/node/u/disk/'.$search);
$statu_disks= json_decode($statu_disks, true);
$statu_disks = is_array($statu_disks[0])?$statu_disks:array($statu_disks);

$statu_status = httpRequest('http://api.icdn.me:8000/node/u/status/'.$search);
$statu_status= json_decode($statu_status, true);
$statu_status = is_array($statu_status[0])?$statu_status:array($statu_status);

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
		<input type="text" placeholder="搜索Pk" name='search'/>
		<input type="submit" value='search'/>
			</form>
		<div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>stationname</td>
				 <td class='title'>os</td>
				 <td class='title'>stationname</td>
				 <td class='title'>os_detail</td>
				 <td class='title'>token</td>
				 <td class='title'>remarks</td>
				 <td class='title'>pk</td>
				 <td class='title'>owner</td>
				 <td class='title'>操作</td>
			 </tr>
			 <?php 
			 	foreach ($status as $statu)
			 	{
			 ?>
			 <tr>
			 	<td style="width: 90% word-break: break-word;"><?php echo $statu['stationname'];?></td>
				 <td ><?php echo $statu['os'];?></td>
				 <td ><?php echo $statu['stationname'];?></td>
				 <td ><?php echo $statu['os_detail'];?></td>
				 <td ><?php echo $statu['token'];?></td>
				 <td ><?php echo $statu['remarks'];?></td>
				 <td><?php echo $statu['pk'];?></td>
				 <td ><?php echo $statu['owner'];?></td>
				 <td><a href="demo.php?delete=info&pk=<?php echo $statu['pk']; ?>">删除</a></td>
			 </tr>
			 <?php 
			 	}
			 ?>
		</table>
		</div>
		<br>
		<br>
		<br>
		<?php require_once 'ipDemo.php';?>
		<?php require_once 'diskDemo.php';?>
		<?php require_once 'statusDemo.php';?>
		<?php require_once 'hardWareDemo.php';?>
    </div>
</div>
