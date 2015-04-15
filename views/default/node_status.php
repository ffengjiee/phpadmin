<?php
try{
if(isset($_GET['delete']))
{
	//必须是本站的删除请求
	$host = $_SERVER['SERVER_NAME'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if(isset($_GET['pk']) && $ref['host'] == $host && $_GET['delete']=='status')
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/disk/'.$_GET['pk'], 'delete');
	}

}
$search = $_GET['search']?$_GET['search']:'';

$statu_status = httpRequest('http://api.icdn.me:8000/node/u/status/'.$search);
$statu_status= json_decode($statu_status, true);
$statu_status = is_array($statu_status[0])?$statu_status:array($statu_status);


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
		<input type="hidden" name="view" value="node_status"/>
		<input type="text" placeholder="搜索Pk" name='search'/>
		<input type="submit" value='search'/>
		</form>

		<b style="font-size: 15px">status状态信息：</b>
	    <div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>node_name</td>
			 	 <td class='title'>pk</td>
				 <td class='title'>cpu</td>
				 <td class='title'>phymem</td>
				 <td class='title'>swapmem</td>
				 <td class='title'>network</td>
				 <td class='title'>isalive</td>

				 <td class='title'>操作</td>
			 </tr>
			 <?php
			 	foreach ($statu_status as $status_ip)
			 	{
			 ?>
			 <tr>
			 	 <td ><?php echo $status_ip['node_name'];?></td>
				 <td ><?php echo $status_ip['pk'];?></td>
				 <td ><?php echo $status_ip['cpu'];?></td>
				 <td ><?php echo $status_ip['phymem'];?></td>
				 <td ><?php echo $status_ip['swapmem'];?></td>
				 <td ><?php echo $status_ip['network'];?></td>
				 <td><?php echo $status_ip['isalive']==true?'true':'false';?></td>
				 <td><a href="demo.php?delete=status&pk=<?php echo $status_ip['pk']; ?>">删除</a></td>
			 </tr>
			 <?php
			 	}
			 ?>
		</table>
		</div>