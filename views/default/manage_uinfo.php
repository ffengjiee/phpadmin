<?php

//优先添加
if(!empty($_POST))
{
		//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if('edit'!= $_POST['method'] && $ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/setting/u/info/','post',array('remarks'=>$_POST['remarks'],'is_global'=>(bool)($_POST['is_global']=='true')));
	}
	if('edit'== $_POST['method'] && $ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/setting/u/info/'.$_POST['pk'],'put',array('remarks'=>$_POST['remarks'],'is_global'=>(bool)($_POST['is_global']=='true')));
	//	var_dump($res);
	}
}
if($_GET['delete']==1)
{
	//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if(isset($_GET['pk']) && $ref['host'] == $host)
	{
		$status = httpRequest('http://api.icdn.me:8000/setting/u/info/'.$_GET['pk'], 'delete');
	}
}

$search = $_GET['search']?$_GET['search']:'';
$detail = httpRequest('http://api.icdn.me:8000/setting/u/info/'.$search);
$details = json_decode($detail, true);
$details = is_array($details[0])?$details:array($details);


?>
<script>
 $(function(){
		  $(".option_detail").bind('click',function(){
			    var v = $(this).parent().children("td:first").text();
				if( $("table."+v).is(":visible") == false){
					$("#option table").not('.grand').hide();
					$("table."+v).show().addClass('showtable');
				}else{
					$("table."+v).hide().removeClass('showtable');;
				}

		  });
		  $(".close").click(function(){
			 $("#option table").not('.grand').hide();
			 $("#add_form,#edit_form").hide();
		  })
		 $("#add_btn").click(function(){
			  if($("#add_form").is(":visible") == false){
					$("#add_form").show().addClass('showtable');
			  }else{
				   $("#add_form").hide().removeClass('showtable');;
			  }

		  })
		$(".edit").click(function(){
			var details = <?php echo json_encode($details);?>;
			  if($("#edit_form").is(":visible") == false){
				$("#edit_form").show().addClass('showtable');
				$("#edit_form input[name='pk']").val(details[$(this).attr("value")].pk);
				$("#edit_form input[name='remarks']").val(details[$(this).attr("value")].remarks);
				$("#edit_form select[name='is_global']").val(details[$(this).attr("value")].is_global+'');
				console.log(details[$(this).attr("value")]);
			  }else{
				   $("#edit_form").hide().removeClass('showtable');;
			  }
			})

})
</script>
<div class="mwin" id="page">
    <div class="hd radius5tr clearfix">
        <h3>u_info</h3>
    </div>
    <div>
		<input type="button" class="btn" id='add_btn' value="添加" />
		<form action="" method='GET' style="text-align: right">
		<input type="hidden" name='view' value='manage_uinfo'/>
		<input type="text" placeholder="搜索Pk" name='search'/>
		<input type="submit" value='search'/>
		</form>
				
		<b style="font-size: 15px">detail_info状态信息：</b>
		<div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>pk</td>
				 <td class='title'>remarks</td>
				 <td class='title'>owner</td>
				 <td class='title'>created</td>
				 <td class='title'>updated</td>
				 <td class='title'>is_global</td>
				 <td class='title'>操作</td>
			 </tr>
			 <?php
			 	foreach ($details as $iloop=>$statu)
			 	{
			 ?>
			 <tr>
			 	 <td class='pk'><?php echo $statu['pk'];?></td>
				 <td ><?php echo $statu['remarks'];?></td>
				 <td ><?php echo $statu['owner'];?></td>
				 <td ><?php echo $statu['created'];?></td>
				 <td ><?php echo $statu['updated'];?></td>
				 <td ><?php echo $statu['is_global']==true?'true':'false';?></td>
 				 <td ><a href="demo.php?view=manage_uinfo&delete=1&pk=<?php echo $statu['pk']; ?>">删除</a>
 				 <a class='edit' value='<?php echo $iloop; ?>'>编辑</a>
 				 </td>
 			 </tr>

			 <?php
			 	}
			 ?>
		</table>
		<div id='add_form'  style="display:none">
			<table class="<?php echo $statu['pk'];?> tble">
				<form action='' method="post">
					<tr><td colspan=2 style='text-align:center' class='close'>关闭</td></tr>
					<input type="hidden" name='pk' />
					<tr><td><b>remarks </b></td><td><input name='remarks' /></td></tr>
					<tr><td><b>is_global</b></td><td><select  name="is_global">
								<option value="true">true</option>
								<option value="false">false</option>
							</select></td></tr>
					<tr><td colspan=2 ><input type='submit' value='add'/></td></tr>
				</form>
			</table>
		</div>
		<div id='edit_form'  style="display:none">
			<table class="<?php echo $statu['pk'];?> tble">
				<form action='' method="post">
					<tr><td colspan=2 style='text-align:center' class='close'>关闭</td></tr>
					<input type="hidden" value='edit' name='method'/>
				    <input type="hidden" value='' name='pk'/>
					<tr><td><b>remarks </b></td><td><input name='remarks' /></td></tr>
					<tr><td><b>is_global</b></td><td><select  name="is_global">
								<option value='true'>true</option>
								<option value='false'>false</option>
							</select></td></tr>
					<tr><td colspan=2 ><input type='submit' value='edit'/></td></tr>
				</form>
			</table>
		</div>
		</div>
		
    </div>
</div>
