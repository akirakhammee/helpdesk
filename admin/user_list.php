<?php
//query data
$stmtuser = $condb->prepare("SELECT * FROM tbl_users WHERE role_user ='user';");
$stmtuser->execute();
$rsuser= $stmtuser->fetchAll();
?>
<h3 class="card-title">รายชื่อสมาชิกลูกบ้าน <a href="user.php?act=add" class="btn btn-primary btn-sm">+เพิ่มข้อมูล</a></h3>
<div class="table-responsive">
<table id="example2" class="table table-bordered table-striped table-hover table-sm">
	<thead>
		<tr class="table table-info">
			<th width="5%">ID</th>
			<th width="60%">เลขห้อง</th>
			<th width="15%">เเก้รหัส</th>
			<th width="5%">แก้ไข</th>
			<th width="5%">ลบ</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($rsuser AS $rsuser){ ?>
		<tr>
			<td><?= $i++;?></td>
			<td><?=$rsuser['username']?></td>
			<td align="center"><a href="user.php?id=<?=$rsuser['id']?>&act=password" class="btn btn-outline-secondary btn-sm" >เเก้รหัสผ่าน</a></td>
			<td align="center"><a href="user.php?id=<?=$rsuser['id']?>&act=edit" class="btn btn-outline-warning btn-sm" >เเก้ไข</a></i></td>
			<td align="center"><a href="user.php?id=<?=$rsuser['id']?>&act=delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่');">ลบ</a></i>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>	
</div>