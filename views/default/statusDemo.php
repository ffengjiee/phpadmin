    	<b style="font-size: 15px">status状态信息：</b>
	    <div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>node_name</td>
			 	 <td class='title'>pk</td>
				 <td class='title'>cpu</td>
				 <td class='title'>phymem</td>
				 <td class='title'>swapmem</td>
				 <td class='title'>network</td>
				 <td class='title'>isalive</td>
				 
				 <td class='title'>操作</td>
			 </tr>
			 <?php 
			 	foreach ($statu_status as $status_ip)
			 	{
			 ?>
			 <tr>
			 	 <td ><?php echo $status_ip['node_name'];?></td>
				 <td ><?php echo $status_ip['pk'];?></td>
				 <td ><?php echo $status_ip['cpu'];?></td>
				 <td ><?php echo $status_ip['phymem'];?></td>
				 <td ><?php echo $status_ip['swapmem'];?></td>
				 <td ><?php echo $status_ip['network'];?></td>
				 <td><?php echo $status_ip['isalive'];?></td>
				 <td><a href="demo.php?delete=status&pk=<?php echo $status_ip['pk']; ?>">删除</a></td>
			 </tr>
			 <?php 
			 	}
			 ?>
		</table>
		</div>