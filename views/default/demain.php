<?php
//优先添加
if(!empty($_POST))
{
	$add = $edit = 'success';
		//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if($_POST['method']=='add' && $ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/demain/u/info/','post',array('remarks'=>$_POST['remarks'],'is_global'=>(bool)$_POST['is_global']));
		if($res === false)
		{
			$add = 'fail';
		}
	}
	if($_POST['method']=='edit' && $ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/demain/u/info','put',$_POST);
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
		$status = httpRequest('http://api.icdn.me:8000/demain/u/info/'.$_GET['pk'], 'delete');
	}
}

$search = $_GET['search']?$_GET['search']:'';
$detail = httpRequest('http://api.icdn.me:8000/domain/u/info/'.$search);
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
				$("#edit_form input[name='full_domain']").val(details[$(this).attr("value")].full_domain);
				$("#edit_form input[name='root_domain']").val(details[$(this).attr("value")].root_domain);
				$("#edit_form input[name='remarks']").val(details[$(this).attr("value")].remarks);
				$("#edit_form input[name='setting']").val(details[$(this).attr("value")].setting);
				$("#edit_form select[name='isalive']").val(details[$(this).attr("value")].isalive);
				$("#edit_form select[name='beian']").val(details[$(this).attr("value")].beian);
				console.log(details);
			  }else{
				   $("#edit_form").hide().removeClass('showtable');;
			  }
			})
	if('<?php echo $add;?>' == 'fail')
		alert('添加失败');
	if('<?php echo $edit;?>' == 'fail')
		alert('更新失败');
})
</script>
<div class="mwin" id="page">
    <div class="hd radius5tr clearfix">
        <h3>demain配置</h3>
    </div>
    <div>
		<input type="button" class="btn" id='add_btn' value="添加" />
		<form action="" method='GET' style="text-align: right">
		<input type="hidden" name='view' value='demain'/>
		<input type="text" placeholder="搜索Pk" name='search' value='<?php echo $_GET["search"]?>'/>
		<input type="submit" value='search'/>
		</form>
		<div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>pk</td>
				 <td class='title'>full_domain</td>
				 <td class='title'>root_domain</td>
				 <td class='title'>isalive</td>
				 <td class='title'>remarks</td>
				 <td class='title'>beian</td>
				 <td class='title'>created</td>
				 <td class='title'>created</td>
				  <td class='title'>操作</td>
			 </tr>
			 <?php
			 	foreach ($details as $iloop => $statu)
			 	{
			 ?>
			 <tr>
			 	 <td class='pk'><?php echo $statu['pk'];?></td>
				 <td ><?php echo $statu['full_domain'];?></td>
				 <td ><?php echo $statu['root_domain'];?></td>
				 <td ><?php echo $statu['isalive'];?></td>
				 <td ><?php echo $statu['remarks'];?></td>
				 <td ><?php echo $statu['beian'];?></td>
				 <td ><?php echo $statu['created'];?></td>
				 <td ><?php echo $statu['created'];?></td>
				 <td><a href="demo.php?view=demain&delete=1&pk=<?php echo $statu['pk']; ?>">删除</a><a class='edit' value=<?php echo $iloop; ?>>编辑</a></td>
 			 </tr>

			 <?php
			 	}
			 ?>
		</table>
		
		<div id='add_form'  style="display:none">
			<table class="<?php echo $statu['pk'];?> tble">
				<form action='' method="post">
				    <input type="hidden" value='add' name='method'/>
					<tr><td colspan=2 style='text-align:center' class='close'>关闭</td></tr>
					<tr><td><b><require>full_domain</require> </b></td><td><input name='full_domain' /></td></tr>
					<tr><td><b>root_domain </b></td><td><input name='root_domain' /></td></tr>
					<tr><td><b>isalive</b></td><td><select  name="isalive">
								<option value="true">true</option>
								<option value="false">false</option>
							</select></td></tr>
					<tr><td><b>remarks </b></td><td><input name='remarks' /></td></tr>
					<tr><td><b>beian</b></td><td><select  name="beian">
								<option value="true">true</option>
								<option value="false">false</option>
							</select></td></tr>
					<tr><td><b><require>setting</require> </b></td><td><input name='setting' /></td></tr>
					<tr><td colspan=2 ><input type='submit' value='add'/></td></tr>
				</form>
			</table>
		</div>
		<div id='edit_form'  style="display:none">
			<table class="<?php echo $statu['pk'];?> tble">
				<form action='' method="post">
				    <input type="hidden" value='edit' name='method'/>
				    <input type="hidden" value='demain' name='view'/>
					<tr><td colspan=2 style='text-align:center' class='close'>关闭</td></tr>
					<tr><td><b><require>full_domain</require> </b></td><td><input name='full_domain' /></td></tr>
					<tr><td><b>root_domain </b></td><td><input name='root_domain' /></td></tr>
					<tr><td><b>isalive</b></td><td><select  name="isalive">
								<option value="true">true</option>
								<option value="false">false</option>
							</select></td></tr>
					<tr><td><b>remarks </b></td><td><input name='remarks' /></td></tr>
					<tr><td><b>beian</b></td><td><select  name="beian">
								<option value="true">true</option>
								<option value="false">false</option>
							</select></td></tr>
					<tr><td><b><require>setting</require> </b></td><td><input name='setting' /></td></tr>
					<tr><td colspan=2 ><input type='submit' value='edit'/></td></tr>
				</form>
			</table>
		</div>
		</div>
    </div>
</div>
