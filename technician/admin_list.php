<?php
//query data
$stmtAdmin = $condb->prepare("SELECT * FROM tbl_users WHERE role_user !='user';");
$stmtAdmin->execute();
$rsAdmin= $stmtAdmin->fetchAll();
?>
<h3 class="card-title">รายชื่อผู้ดูแลระบบ <a href="admin.php?act=add" class="btn btn-primary btn-sm">+เพิ่มข้อมูล</a></h3>
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
			<td><?=$rsAdmin['name']?></td>
			<td><?=$rsAdmin['username']?></td>
			<td><?=$rsAdmin['role_user']?></td>
			<td align="center"><a href="admin.php?id=<?=$rsAdmin['id']?>&act=password" class="btn btn-outline-Secondary btn-sm" >เเก้รหัสผ่าน</a></td>
			<td align="center"><a href="admin.php?id=<?=$rsAdmin['id']?>&act=edit" class="btn btn-outline-warning btn-sm" >เเก้ไข</a></i>
			</td>
			<td align="center"><a href="admin.php?id=<?=$rsAdmin['id']?>&act=delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่');">ลบ</a></i>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>	
</div>