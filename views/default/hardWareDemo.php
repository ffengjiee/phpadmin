		<b style="font-size: 15px">hard_ware状态信息：</b>
	    <div  class="state">
		<table >
			 <tr style='border-bottom-style: groove'>
			 	 <td class='title'>node_name</td>
			 	 <td class='title'>pk</td>
				 <td class='title'>cpu</td>
				 <td class='title'>phymem</td>
				 <td class='title'>swapmem</td>
				 <td class='title'>disk</td>
				 
				 <td class='title'>操作</td>
			 </tr>
			 <?php 
			 	foreach ($statu_hardware as $hardware)
			 	{
			 ?>
			 <tr>
			 	 <td ><?php echo $hardware['node_name'];?></td>
				 <td ><?php echo $hardware['pk'];?></td>
				 <td ><?php echo $hardware['cpu'];?></td>
				 <td ><?php echo $hardware['phymem'];?></td>
				 <td ><?php echo $hardware['swapmem'];?></td>
				 <td ><?php echo $hardware['disk'];?></td>
				 <td><a href="demo.php?delete=hardware&pk=<?php echo $hardware['pk']; ?>">删除</a></td>
			 </tr>
			 <?php 
			 	}
			 ?>
		</table>
		</div>