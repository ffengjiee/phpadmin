		<b style="font-size: 15px">IP状态信息：</b>
	    <div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>node_name</td>
			 	 <td class='title'>pk</td>
				 <td class='title'>ip</td>
				 <td class='title'>net</td>
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