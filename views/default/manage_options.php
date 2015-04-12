<?php

//优先添加
if(!empty($_POST))
{
		//必须是本站的删除请求
	$host = $_SERVER['HTTP_HOST'];
	$ref = parse_url($_SERVER['HTTP_REFERER']);
	if('edit'!= $_POST['method'] && $ref['host'] == $host){
		$res = httpRequest('http://api.icdn.me:8000/setting/u/options/','post',array('remarks'=>$_POST['remarks'],'is_global'=>(bool)$_POST['is_global']));
	}
	if('edit'== $_POST['method'] && $ref['host'] == $host){
		settype($_POST['gzip'],'boolean');
		settype($_POST['proxy_buffering'],'boolean');
		settype($_POST['proxy_cache'],'boolean');
		settype($_POST['proxy_cache_lock'],'boolean');
		settype($_POST['proxy_ignore_client_abort'],'boolean');
		settype($_POST['proxy_intercept_errors'],'boolean');
		$res = httpRequest('http://api.icdn.me:8000/setting/u/options/'.$_POST['pk'],'put',array('remarks'=>$_POST['remarks'],'is_global'=>(bool)$_POST['is_global']));
		//
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
		$status = httpRequest('http://api.icdn.me:8000/setting/u/options/'.$_GET['pk'], 'delete');
	}
}

$search = $_GET['search']?$_GET['search']:'';
$detail = httpRequest('http://api.icdn.me:8000/setting/u/options/'.$search);
$details = json_decode($detail, true);
$details = is_array($details[0])?$details:array($details);


?>
<script>
 $(function(){
	 $("#alpha").hide();
		  $(".option_detail").bind('click',function(){
			    var v = $(this).parent().children("td:first").text();
				if( $("table."+v).is(":visible") == false){
					$("#option table").not('.grand').hide();
					$("table."+v).show().addClass('showtable');
					$("#alpha").show().css('z-index',2);
				}else{
					$("table."+v).hide().removeClass('showtable');
					$("#alpha").hide().css('z-index',0);
				}

		  });
		  $(".close").click(function(){
			 $("#option table").not('.grand').hide();
			 $("#add_form,#edit_form").hide();
			 $("#alpha").hide().css('z-index',0);
		  })
		 $("#add_btn").click(function(){
			  if($("#add_form").is(":visible") == false){
					$("#add_form").show().addClass('showtable');
					$("#alpha").show().css('z-index',2);
			  }else{
				   $("#add_form").hide().removeClass('showtable');
				   $("#alpha").hide().css('z-index',0);
			  }

		  })
		$(".edit").click(function(){
			var details = <?php echo json_encode($details);?>;
			  if($("#edit_form").is(":visible") == false){
				$("#edit_form").show().addClass('showtable');
				$("#alpha").show().css('z-index',2);
				$("#edit_form input[name='pk']").val(details[$(this).attr("value")].pk+'');
				$("#edit_form select[name='gzip']").val(details[$(this).attr("value")].gzip+'');
				$("#edit_form input[name='gzip_min_length']").val(details[$(this).attr("value")].gzip_min_length+'');
				$("#edit_form input[name='gzip_comp_level']").val(details[$(this).attr("value")].gzip_comp_level+'');
				$("#edit_form input[name='gzip_types']").val(details[$(this).attr("value")].gzip_types+'');
				$("#edit_form input[name='gzip_disable']").val(details[$(this).attr("value")].gzip_disable+'');
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
				$("#edit_form input[name='index']").val(details[$(this).attr("value")].index+'');
				console.log(details[$(this).attr("value")]);
			  }else{
				   $("#edit_form").hide().removeClass('showtable');
				   $("#alpha").hide().css('z-index',0);
			  }
			})

})
</script>
<div class="mwin" id="page">
    <div class="hd radius5tr clearfix">
        <h3>u_options</h3>
    </div>
    <div>
		<input type="button" class="btn" id='add_btn' value="添加" />
		<form action="" method='GET' style="text-align: right">
				<input type="hidden" name='view' value='manage_options'/>
		<input type="text" placeholder="搜索Pk" name='search'/>
		<input type="submit" value='search'/>
		</form>
				
		<b style="font-size: 15px">detail_options状态信息：</b>
		<div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	<td class='title'>pk</td>
				<td class='title'>gzip</td>
				<td class='title'>gzip_min_length</td>
				<td class='title'>gzip_comp_level</td>
				<td class='title'>gzip_types</td>
				<td class='title'>gzip_disable</td>
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
				<td class='title'>index</td>
				<td class='title'>locations_set</td>
				<td class='title'>操作</td>
			 </tr>
			 <?php
			 	foreach ($details as $iloop=>$statu)
			 	{
			 ?>
			 <tr>
			    <td style='display: none'><?php echo $iloop;?></td>
			    <td ><?php echo $statu['pk'];?></td>
				<td ><?php echo $statu['gzip'];?></td>
				<td ><?php echo $statu['gzip_min_length'];?></td>
				<td ><?php echo $statu['gzip_comp_level'];?></td>
				<td ><?php echo $statu['gzip_types'];?></td>
				<td ><?php echo $statu['gzip_disable'];?></td>
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
				<td ><?php echo $statu['index'];?></td>
				<td class='option_detail'>查看option</td>
 				 <td ><!-- <a href="demo.php?view=manage_options&delete=1&pk=<?php echo $statu['pk']; ?>">删除</a>-->
 				 <a class='edit' value='<?php echo $iloop; ?>'>编辑</a>
 				 </td>
 			 </tr>

			 <?php
			 	}
			 ?>
		</table>
		<div id='option'>
		 <?php
			 	foreach ($details as $iloop=>$statu)
			 	{
			 ?>

				 	<table class="<?php echo $iloop;?> tble" style="display:none">
					<tr><td colspan=2 style='text-align:center' class='close'>关闭</td></tr>
				 	<?php  foreach ($statu['locations_set'] as $key=>$option){?>
				 	<tr><td><b><?php  echo $key?> </b></td><td>
				 	<?php 
				 	if(is_array($option))
				 	{
				 		$str = '<br><table class="grand">';
				 		foreach ($option as $opk => $op)
				 		{
					 			$str .= '<tr><td>'.$opk.'</td><td>'.$op.'</td></tr>';
					 		
				 		}
				 		$str .= '</table><br>';
				 		echo $str;
				 	}else {
				 		echo $option;
				 	}
				 	?></td></tr>
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
					<td>		<input class="parameter required" minlength="1" name="pk" placeholder="(required)" type="text" value="">
					</td>
					</tr><tr><td class="code">gzip</td>
					<td>
					  <select class="parameter" name="gzip">
					          <option selected="" value=""></option>
					        <option value="off">off</option>
					        <option value="on">on</option>
					</select>
					</td>
					</tr><tr><td class="code">gzip_min_length</td>
					<td>
					<input class="parameter" minlength="0" name="gzip_min_length" placeholder="" type="text" value="">
					</td>
					 </tr><tr><td class="code">gzip_comp_level</td>
					<td>
					<input class="parameter" minlength="0" name="gzip_comp_level" placeholder="" type="text" value="">
					</td>
					 </tr><tr><td class="code">gzip_types</td>
					<td>
					<input class="parameter" minlength="0" name="gzip_types" placeholder="" type="text" value="">
					</td>
					 </tr><tr><td class="code">gzip_disable</td>
					<td>
					<input class="parameter" minlength="0" name="gzip_disable" placeholder="" type="text" value="">
					</td>
					 </tr><tr><td class="code">proxy_buffering</td>
					<td>
					  <select class="parameter" name="proxy_buffering">
					<option selected="" value=""></option>
					<option value="off">off</option>
					<option value="on">on</option>
					</select>
					</td>
					</tr><tr><td class="code">proxy_cache</td>
					<td>
					  <select class="parameter" name="proxy_cache">
					<option selected="" value=""></option>
					<option value="off">off</option>
					<option value="cache_one">cache_one</option>
					</select>
					</td>
					</tr><tr><td class="code">proxy_cache_key</td>
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
					</td>
					 </tr><tr><td class="code">proxy_cache_lock_timeout</td>
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
					</td>
					</tr><tr><td class="code">proxy_intercept_errors</td>
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
					<td>
					<input class="parameter" minlength="0" name="proxy_set_header" placeholder="" type="text" value="">
					</td>
					 </tr><tr><td class="code">index</td>
					<td>
					<input class="parameter" minlength="0" name="index" placeholder="" type="text" value="">
					</td>
					 </tr> 
					<tr><td colspan=2 ><input type='submit' value='edit'/></td></tr>
				</form>
			</table>
		</div>
		</div>
    </div>
</div>

<div id='alpha'></div>
