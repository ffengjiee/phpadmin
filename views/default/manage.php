<?php 
if($_GET['delete']==1)
{
	//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if(isset($_GET['pk']) && $ref['host'] == $host)
	{
		$status = httpRequest('http://api.icdn.me:8000/node/u/ip/'.$_GET['pk'], 'delete');
	}
}
$detail = httpRequest('http://api.icdn.me:8000/setting/u/detail-info/');
$details = json_decode($detail, true);


?>
<script>
 $(function(){
		  $(".option_detail").bind('click',function(){
			    var v = $(this).parent().children("td:first").text();
			    $("table."+v).show();
			    $(this).bind("click",function(){
			    	 $("table."+v).hide();
				})
		  });
}) 
</script>
<div class="mwin" id="page">
    <div class="hd radius5tr clearfix">
        <h3>用户配置</h3>
    </div>
    <div>
		<!-- <input type="button" class="btn" id='btn' value="刷新" /> -->
		<div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>pk</td>
				 <td class='title'>remarks</td>
				 <td class='title'>owner</td>
				 <td class='title'>created</td>
				 <td class='title'>updated</td>
				 <td class='title'>is_global</td>
				 <td class='title'>option</td>
			 </tr>
			 <?php 
			 	foreach ($details as $statu)
			 	{
			 ?>
			 <tr>
			 	 <td class='pk'><?php echo $statu['pk'];?></td>
				 <td ><?php echo $statu['remarks'];?></td>
				 <td ><?php echo $statu['owner'];?></td>
				 <td ><?php echo $statu['created'];?></td>
				 <td ><?php echo $statu['updated'];?></td>
				 <td ><?php echo $statu['is_global'];?></td>
 				<td class='option_detail'>查看option</td>
 			 </tr>
			 
			 <?php 
			 	}
			 ?>
		</table>
		<div id='option'>
		 <?php 
			 	foreach ($details as $statu)
			 	{
			 ?>
			
				 	<table class="<?php echo $statu['pk'];?> tble" style="display:none">
				 	<?php foreach ($statu['options'] as $key=>$option){?>
				 	<tr><td><b><?php echo $key?> </b></td><td><?php echo $option?></td></tr>
				 	<?php }?>
				 	</table>
		 
	    <?php 
			 	}
			 ?>
		</div>
		</div>
    </div>
</div>
