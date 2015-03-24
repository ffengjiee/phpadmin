		<b style="font-size: 15px">disk状态信息：</b>
	    <div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>node_name</td>
			 	 <td class='title'>pk</td>
				 <td class='title'>path</td>
				 <td class='title'>total</td>
				 <td class='title'>used</td>
				 <td class='title'>rest</td>
				 <td class='title'>percent</td>
				 <td class='title'>node</td>
				 
				 <td class='title'>操作</td>
			 </tr>
			 <?php 
			 	foreach ($statu_disks as $status_disk)
			 	{
			 ?>
			 <tr>
			 	 <td ><?php echo $status_disk['node_name'];?></td>
				 <td ><?php echo $status_disk['pk'];?></td>
				 <td ><?php echo $status_disk['path'];?></td>
				 <td ><?php echo $status_disk['total'];?></td>
				 <td ><?php echo $status_disk['used'];?></td>
				 <td ><?php echo $status_disk['rest'];?></td>
				 <td> <?php echo $status_disk['percent'];?></td>
				 <td ><?php echo $status_disk['node'];?></td>
				 <td><a href="demo.php?delete=disk&pk=<?php echo $status_disk['pk']; ?>">删除</a></td>
			 </tr>
			 <?php 
			 	}
			 ?>
		</table>
		</div>