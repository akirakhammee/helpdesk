<?php
//query data
$stmtAdmin = $condb->prepare("SELECT * FROM tbl_users");
$stmtAdmin->execute();
$rsAdmin= $stmtAdmin->fetchAll();
?>
<h3 class="card-title">ข้อมูลตาราง
	<a href="admin.php?act=add&role_user=admin" class="btn btn-primary btn-sm">+เพิ่มข้อมูลเเอดมิน/ช่าง  </a></h3>
	<a href="admin.php?act=add&role_user=user" class="btn btn-info btn-sm">+เพิ่มข้อมูลลูกบ้าน</a></h3>
<div class="table-responsive">
<table id="example2" class="table table-bordered table-striped table-hover table-sm">
	<thead>
		<tr class="table table-info">
			<th width="5%">ID</th>
			<th width="30%">ชื่อ</th>
			<th width="30%">Username</th>
			<th width="20%">ระดับ</th>
			<th width="10%">เเก้รหัส</th>
			<th width="5%">แก้ไข</th>
			<th width="5%">ลบ</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($rsAdmin AS $rsAdmin){ ?>
		<tr>
			<td><?= $i++;?></td>
			<td><?php 
				if($rsAdmin['name'] ==''){
					echo $rsAdmin['username'];
				}else{
					echo $rsAdmin['name'];
				}
					
		    ?>
			</td>
				
			<td><?=$rsAdmin['username']?></td>
			<td><?=$rsAdmin['role_user']?></td>
			<td align="center"><a href="admin.php?id=<?=$rsAdmin['id']?>&act=password&role_user=<?=$rsAdmin['role_user']?>" class="btn btn-outline-secondary btn-sm" >เเก้รหัสผ่าน</a></td>
			<td align="center"><a href="admin.php?id=<?=$rsAdmin['id']?>&act=edit&role_user=<?=$rsAdmin['role_user']?>" class="btn btn-outline-warning btn-sm" >เเก้ไข</a></i>
			</td>
			<td align="center"><a href="admin.php?id=<?=$rsAdmin['id']?>&act=delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่');">ลบ</a></i>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>	
</div>