<?php
$search = $_GET['search']?$_GET['search']:'';
$detail = httpRequest('http://api.icdn.me:8000/domain/u/web/'.$search);
$details = json_decode($detail, true);
$details = is_array($details[0])?$details:array($details);


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
        <h3>u_web</h3>
    </div>
    <div>
		<input type="button" class="btn" id='btn' value="刷新" />
		<!-- <form action="" method='GET' style="text-align: right">
		<input type="hidden" name='view' value='u_web'/>
		<input type="text" placeholder="搜索Pk" name='search' value='<?php echo $_GET["search"]?>'/>
		<input type="submit" value='search'/>
		</form>-->
		<div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>code_200</td>
				 <td class='title'>code_304</td>
				 <td class='title'>code_404</td>
				 <td class='title'>code_500</td>
				 <td class='title'>code_other</td>
				 <td class='title'>ctime</td>
				  <td class='title'>node</td>
			 </tr>
			 <?php
			 	foreach ($details as $iloop => $statu)
			 	{
			 ?>
			 <tr>
			 	 <td class='pk'><?php echo $statu['code_200'];?></td>
				 <td ><?php echo $statu['code_304'];?></td>
				 <td ><?php echo $statu['code_404'];?></td>
				 <td ><?php echo $statu['code_500'];?></td>
				 <td ><?php echo $statu['code_other'];?></td>
				 <td ><?php echo $statu['ctime'];?></td>
				 <td ><?php echo $statu['node'];?></td>
				 </tr>

			 <?php
			 	}
			 ?>
		</table>
		</div>
    </div>
</div>
