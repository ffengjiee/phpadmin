<?php
try{
if(isset($_GET['delete']))
{
	//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if(isset($_GET['pk']) && $ref['host'] == $host && $_GET['delete']=='ip')
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/ip/'.$_GET['pk'], 'delete');
	}

}
$search = $_GET['search']?$_GET['search']:'';

$statu_ip = httpRequest('http://api.icdn.me:8000/node/u/ip/'.$search);
$status_ips= json_decode($statu_ip, true);
$status_ips = is_array($status_ips[0])?$status_ips:array($status_ips);

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
		<input type="hidden" name="view" value="node_ip"/>
		<input type="text" placeholder="搜索Pk" name='search'/>
		<input type="submit" value='search'/>
		</form>
		<b style="font-size: 15px">IP状态信息：</b>
	    <div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>node_name</td>
			 	 <td class='title'>pk</td>
				 <td class='title'>ip</td>
				 <td class='title'>net</td>
				 <td class='title'>isalive</td>
				 <td class='title'>bandwidth</td>
				 <td class='title'>mac</td>
				 <td class='title'>netflow_in</td>
				 <td class='title'>netspeed_out</td>
				 <td class='title'>ip_class</td>
				 <td class='title'>networkcard</td>
				 <td class='title'>node</td>
				 
				 <td class='title'>操作</td>
			 </tr>
			 <?php 
			 	foreach ($status_ips as $status_ip)
			 	{
			 ?>
			 <tr>
			 	 <td ><?php echo $status_ip['node_name'];?></td>
				 <td ><?php echo $status_ip['pk'];?></td>
				 <td ><?php echo $status_ip['ip'];?></td>
				 <td ><?php echo $status_ip['net'];?></td>
				  <td ><?php echo $status_ip['isalive']==true?'true':'false';?></td>
				 <td ><?php echo $status_ip['bandwidth'];?></td>
				 <td ><?php echo $status_ip['mac'];?></td>
				 <td><?php echo $status_ip['netflow_in'];?></td>
				 <td ><?php echo $status_ip['netspeed_out'];?></td>
				 <td ><?php echo $status_ip['ip_class'];?></td>
				 <td ><?php echo $status_ip['networkcard'];?></td>
				 <td ><?php echo $status_ip['node'];?></td>
				 <td><a href="demo.php?delete=ip&pk=<?php echo $status_ip['pk']; ?>">删除</a></td>
			 </tr>
			 <?php 
			 	}
			 ?>
		</table>
		</div>
    </div>
</div>