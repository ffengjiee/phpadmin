<?php

//优先添加
if(!empty($_POST))
{
		//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if($ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/setting/u/info/','post',array('remarks'=>$_POST['remarks'],'is_global'=>(bool)$_POST['is_global']));
		var_dump($res);
	}
}
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

$search = $_GET['search']?$_GET['search']:'';
$detail = httpRequest('http://api.icdn.me:8000/setting/u/detail-info/'.$search);
$details = json_decode($detail, true);
$details = is_array($details[0])?$details:array($details);


?>
<script>
 $(function(){
		  $(".option_detail").bind('click',function(){
			    var v = $(this).parent().children("td:first").text();
				if( $("table."+v).is(":visible") == false){
					$("#option table").hide();
					$("table."+v).show().addClass('showtable');
				}else{
					$("table."+v).hide().removeClass('showtable');;
				}

		  });
		  $(".close").click(function(){
			 $("#option table").hide();
			 $("#add_form").hide();
		  })
		 $("#add_btn").click(function(){
			  if($("#add_form").is(":visible") == false){
					$("#add_form").show().addClass('showtable');
			  }else{
				   $("#add_form").hide().removeClass('showtable');;
			  }

		  })

})
</script>
<div class="mwin" id="page">
    <div class="hd radius5tr clearfix">
        <h3>用户配置</h3>
    </div>
    <div>
		<input type="button" class="btn" id='add_btn' value="添加" />
		<form action="" method='GET' style="text-align: right">
		<input type="text" placeholder="搜索Pk" name='search'/>
		<input type="submit" value='search'/>
		</form>
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
				 <td class='title'>操作</td>
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
					<tr><td colspan=2 style='text-align:center' class='close'>关闭</td></tr>
				 	<?php if(!empty($status['options'])) foreach ($statu['options'] as $key=>$option){?>
				 	<tr><td><b><?php echo $key?> </b></td><td><?php echo $option?></td></tr>
				 	<?php }?>
				 	</table>

	    <?php
			 	}
			 ?>
		</div>
		<div id='add_form'  style="display:none">
			<table class="<?php echo $statu['pk'];?> tble">
				<form action='' method="post">
					<tr><td colspan=2 style='text-align:center' class='close'>关闭</td></tr>
					<tr><td><b>remarks </b></td><td><input name='remarks' /></td></tr>
					<tr><td><b>is_global</b></td><td><select  name="is_global">
								<option value="true">true</option>
								<option value="false">false</option>
							</select></td></tr>
					<tr><td colspan=2 ><input type='submit' value='add'/></td></tr>
				</form>
			</table>
		</div>
		</div>
    </div>
</div>
