<?php
//优先添加
if(!empty($_POST))
{
	$add = $edit = 'success';
		//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
/* 	if($_POST['method']=='add' && $ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/demain/u/status/','post',array('remarks'=>$_POST['remarks'],'is_global'=>(bool)$_POST['is_global']));
		if($res === false)
		{
			$add = 'fail';
		}
	} */
	if($_POST['method']=='edit' && $ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/domain/u/status/'.$_POST['pk'],'put',$_POST);
		var_dump($res);
		if($res === false)
		{
			$edit = 'fail';
		}
	}
}
if($_GET['delete']==1)
{
	//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if(isset($_GET['pk']) && $ref['host'] == $host)
	{
		$status = httpRequest('http://api.icdn.me:8000/domain/u/status/'.$_GET['pk'], 'delete');
	}
}

$search = $_GET['search']?$_GET['search']:'';
$detail = httpRequest('http://api.icdn.me:8000/domain/u/status/'.$search);
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
			 $("#add_form").hide();
			 $("#edit_form").hide();
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
				$("#edit_form input[name='pk']").val(details[$(this).attr("value")].id);
				$("#edit_form select[name='sync_status']").val(details[$(this).attr("value")].sync_status+'');
				$("#edit_form input[name='node_num']").val(details[$(this).attr("value")].node_num);
				$("#edit_form input[name='netflow_used']").val(details[$(this).attr("value")].netflow_used);
				$("#edit_form input[name='domain']").val(details[$(this).attr("value")].domain);
			  }else{
				   $("#edit_form").hide().removeClass('showtable');;
			  }
			})
	if('<?php echo $add;?>' == 'fail')
		alert('添加失败');
	if('<?php echo $edit;?>' == 'fail')
		alert('更新失败');
	$("#btn").bind("click",function(){
		window.location.reload();
	})
})
 
</script>
<div class="mwin" id="page">
    <div class="hd radius5tr clearfix">
        <h3>demain_status配置</h3>
    </div>
    <div>
		<input type="button" class="btn" id='btn' value="刷新" />
		<form action="" method='GET' style="text-align: right">
		<input type="hidden" name='view' value='demain_status'/>
		<input type="text" placeholder="搜索Pk" name='search' value='<?php echo $_GET["search"]?>'/>
		<input type="submit" value='search'/>
		</form>
		<div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>id</td>
				 <td class='title'>sync_status</td>
				 <td class='title'>node_num</td>
				 <td class='title'>netflow_used</td>
				 <td class='title'>updated</td>
				 <td class='title'>domain</td>
				  <td class='title'>操作</td>
			 </tr>
			 <?php
			 	foreach ($details as $iloop => $statu)
			 	{
			 ?>
			 <tr>
			 	 <td class='pk'><?php echo $statu['id'];?></td>
				 <td ><?php echo $statu['sync_status']==true?'true':'false';?></td>
				 <td ><?php echo $statu['node_num'];?></td>
				 <td ><?php echo $statu['netflow_used'];?></td>
				 <td ><?php echo $statu['updated'];?></td>
				 <td ><?php echo $statu['domain'];?></td>
				 <td><a href="demo.php?view=demain_status&delete=1&pk=<?php echo $statu['pk']; ?>">删除</a><a class='edit' value=<?php echo $iloop; ?>>编辑</a></td>
 			 </tr>

			 <?php
			 	}
			 ?>
		</table>
		<div id='edit_form'  style="display:none">
			<table class="<?php echo $statu['pk'];?> tble">
				<form action='' method="post">
				    <input type="hidden" value='edit' name='method'/>
				    <input type="hidden" value='demain_status' name='view'/>
					<tr><td colspan=2 style='text-align:center' class='close'>关闭</td></tr>
					<tr><td><b><require>pk</require> </b></td><td><input name='pk' /></td></tr>
					<tr><td><b>sync_status</b></td><td><select  name="sync_status">
								<option value="true">true</option>
								<option value="false">false</option>
							</select></td></tr>
					<tr><td><b>node_num </b></td><td><input name='node_num' /></td></tr>
					<tr><td><b><require>netflow_used</require> </b></td><td><input name='netflow_used' /></td></tr>
					<tr><td><b><require>domain</require> </b></td><td><input name='domain' /></td></tr>
					<tr><td colspan=2 ><input type='submit' value='edit'/></td></tr>
				</form>
			</table>
		</div>
		</div>
    </div>
</div>
