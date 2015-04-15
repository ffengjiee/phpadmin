<?php

//优先添加
if(!empty($_POST))
{
		//必须是本站的删除请求
	$host = $_SERVER['SERVER_NAME'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if('edit'!= $_POST['method'] && $ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/setting/u/locations/','post',array('remarks'=>$_POST['remarks'],'is_global'=>(bool)$_POST['is_global']));
	}
	if('edit'== $_POST['method'] && $ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/setting/u/locations/'.$_POST['pk'],'put',$_POST);
		//var_dump($res);
	}
}
if($_GET['delete']==1)
{
	//必须是本站的删除请求
	$host = $_SERVER['SERVER_NAME'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if(isset($_GET['pk']) && $ref['host'] == $host)
	{
		$status = httpRequest('http://api.icdn.me:8000/setting/u/locations/'.$_GET['pk'], 'delete');
	}
}

$search = $_GET['search']?$_GET['search']:'';
$detail = httpRequest('http://api.icdn.me:8000/setting/u/locations/'.$search);
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
				$("#edit_form").show().addClass('showtable').css("width",'70%');
				$("#edit_form input[name='pk']").val(details[$(this).attr("value")].id+'');
				$("#edit_form input[name='path']").val(details[$(this).attr("value")].path+'');
				$("#edit_form select[name='proxy_buffering']").val(details[$(this).attr("value")].proxy_buffering+'');
				$("#edit_form select[name='proxy_cache']").val(details[$(this).attr("value")].proxy_cache+'');
				$("#edit_form input[name='proxy_cache_key']").val(details[$(this).attr("value")].proxy_cache_key+'');
				$("#edit_form select[name='proxy_cache_lock']").val(details[$(this).attr("value")].proxy_cache_lock+'');
				$("#edit_form input[name='proxy_cache_lock_timeout']").val(details[$(this).attr("value")].proxy_cache_lock_timeout+'');
				$("#edit_form input[name='proxy_cache_min_uses']").val(details[$(this).attr("value")].proxy_cache_min_uses+'');
				$("#edit_form input[name='proxy_cache_use_stale']").val(details[$(this).attr("value")].proxy_cache_use_stale+'');
				$("#edit_form input[name='proxy_cache_valid_httpcode']").val(details[$(this).attr("value")].proxy_cache_valid_httpcode+'');
				$("#edit_form input[name='proxy_cache_valid_time']").val(details[$(this).attr("value")].proxy_cache_valid_time+'');
				$("#edit_form input[name='proxy_hide_header']").val(details[$(this).attr("value")].proxy_hide_header+'');
				$("#edit_form select[name='proxy_ignore_client_abort']").val(details[$(this).attr("value")].proxy_ignore_client_abort+'');
				$("#edit_form select[name='proxy_intercept_errors']").val(details[$(this).attr("value")].proxy_intercept_errors+'');
				$("#edit_form input[name='proxy_no_cache']").val(details[$(this).attr("value")].proxy_no_cache+'');
				$("#edit_form input[name='proxy_set_header']").val(details[$(this).attr("value")].proxy_set_header+'');
				$("#edit_form input[name='options']").val(details[$(this).attr("value")].options+'');
			  }else{
				   $("#edit_form").hide().removeClass('showtable');;
			  }
			})


})
</script>
<div class="mwin" id="page">
    <div class="hd radius5tr clearfix">
        <h3>u_locations</h3>
    </div>
    <div>
		<input type="button" class="btn" id='add_btn' value="添加" />
		<form action="" method='GET' style="text-align: right">
		<input type="hidden" name='view' value='manage_locations'/>
		<input type="text" placeholder="搜索Pk" name='search'/>
		<input type="submit" value='search'/>
		</form>

		<b style="font-size: 15px">detail_locations状态信息：</b>
		<div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
					<td class='title'>id</td>
					<td class='title'>path</td>
					<td class='title'>proxy_buffering</td>
					<td class='title'>proxy_cache</td>
					<td class='title'>proxy_cache_key</td>
					<td class='title'>proxy_cache_lock</td>
					<td class='title'>proxy_cache_lock_timeout</td>
					<td class='title'>proxy_cache_min_uses</td>
					<td class='title'>proxy_cache_use_stale</td>
					<td class='title'>proxy_cache_valid_httpcode</td>
					<td class='title'>proxy_cache_valid_time</td>
					<td class='title'>proxy_hide_header</td>
					<td class='title'>proxy_ignore_client_abort</td>
					<td class='title'>proxy_intercept_errors</td>
					<td class='title'>proxy_no_cache</td>
					<td class='title'>proxy_set_header</td>
					<td class='title'>options</td>
				    <td class='title'>操作</td>
			 </tr>
			 <?php
			 	foreach ($details as $iloop=>$statu)
			 	{
			 ?>
			 <tr>
				<td ><?php echo $statu['id'];?></td>
				<td ><?php echo $statu['path'];?></td>
				<td ><?php echo $statu['proxy_buffering'];?></td>
				<td ><?php echo $statu['proxy_cache'];?></td>
				<td ><?php echo $statu['proxy_cache_key'];?></td>
				<td ><?php echo $statu['proxy_cache_lock'];?></td>
				<td ><?php echo $statu['proxy_cache_lock_timeout'];?></td>
				<td ><?php echo $statu['proxy_cache_min_uses'];?></td>
				<td ><?php echo $statu['proxy_cache_use_stale'];?></td>
				<td ><?php echo $statu['proxy_cache_valid_httpcode'];?></td>
				<td ><?php echo $statu['proxy_cache_valid_time'];?></td>
				<td ><?php echo $statu['proxy_hide_header'];?></td>
				<td ><?php echo $statu['proxy_ignore_client_abort'];?></td>
				<td ><?php echo $statu['proxy_intercept_errors'];?></td>
				<td ><?php echo $statu['proxy_no_cache'];?></td>
				<td ><?php echo $statu['proxy_set_header'];?></td>
				<td ><?php echo $statu['options'];?></td>
 				<td ><!-- <a href="demo.php?view=manage_locations&delete=1&pk=<?php echo $statu['id']; ?>">删除</a> -->
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
					<tr><td class="code required">pk</td>
					<td>
					<input class="parameter required" minlength="1" name="pk" placeholder="(required)" type="text" value="">
					</td>
					</tr><tr><td class="code">path</td>
					<td>
					<input class="parameter" minlength="0" name="path" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code">proxy_buffering</td>
					<td>
					  <select class="parameter" name="proxy_buffering">
					<option selected="" value=""></option>
					<option value="off">off</option>
					<option value="on">on</option>
					 </select>
					</td></tr><tr><td class="code">proxy_cache</td>
					<td>
					  <select class="parameter" name="proxy_cache">
					 <option selected="" value=""></option>
					 <option value="off">off</option>
					 <option value="cache_one">cache_one</option>
					 </select>
					</td></tr><tr><td class="code">proxy_cache_key</td>
					<td>
					<input class="parameter" minlength="0" name="proxy_cache_key" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code">proxy_cache_lock</td>
					<td>
					  <select class="parameter" name="proxy_cache_lock">
					 <option selected="" value=""></option>
					  <option value="off">off</option>
					 <option value="on">on</option>
					 </select>
					</td></tr><tr><td class="code">proxy_cache_lock_timeout</td>
					<td>
					<input class="parameter" minlength="0" name="proxy_cache_lock_timeout" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code">proxy_cache_min_uses</td>
					<td>
					<input class="parameter" minlength="0" name="proxy_cache_min_uses" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code">proxy_cache_use_stale</td>
					<td>
					<input class="parameter" minlength="0" name="proxy_cache_use_stale" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code">proxy_cache_valid_httpcode</td>
					<td>
					<input class="parameter" minlength="0" name="proxy_cache_valid_httpcode" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code">proxy_cache_valid_time</td>
					<td>
					<input class="parameter" minlength="0" name="proxy_cache_valid_time" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code">proxy_hide_header</td>
					<td>
					<input class="parameter" minlength="0" name="proxy_hide_header" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code">proxy_ignore_client_abort</td>
					<td>
					  <select class="parameter" name="proxy_ignore_client_abort">
					  <option selected="" value=""></option>
					   <option value="off">off</option>
					  <option value="on">on</option>
					  </select>
					</td></tr><tr><td class="code">proxy_intercept_errors</td>
					<td>
					  <select class="parameter" name="proxy_intercept_errors">
					     <option selected="" value=""></option>
					     <option value="off">off</option>
					     <option value="on">on</option>
					    </select>
					</td>
					</tr><tr><td class="code">proxy_no_cache</td>
					<td>
					<input class="parameter" minlength="0" name="proxy_no_cache" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code">proxy_set_header</td>
					<td><input class="parameter" minlength="0" name="proxy_set_header" placeholder="" type="text" value="">
					</td>
					</tr><tr><td class="code required">options</td>
					<td>
						<input class="parameter required" minlength="1" name="options" placeholder="(required)" type="text" value="">
					</td>
					</tr>
					<tr><td colspan=2 ><input type='submit' value='edit'/></td></tr>
				</form>
			</table>
		</div>
		</div>

    </div>
</div>
