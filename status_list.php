<?php
//query data
$stmtstatus = $condb->prepare("SELECT * FROM tbl_status");
$stmtstatus->execute();
$rsstatus= $stmtstatus->fetchAll();
?>
<h3 class="card-title">รายการสถานะการเเจ้งซ่อม <a href="status.php?act=add" class="btn btn-primary btn-sm">+เพิ่มข้อมูล</a></h3>
<div class="table-responsive">
<table id="example2" class="table table-bordered table-striped table-hover table-sm">
	<thead>
		<tr class="table table-info">
			<th width="10%">ID</th>
			<th width="85%">รายการ</th>
			<th width="5%">แก้ไข</th>
			<th width="5%">ลบ</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($rsstatus AS $rsstatus){ ?>
		<tr>
			<td><?= $i++;?></td>
			<td><?=$rsstatus['status_name']?></td>
			<td align="center"><a href="status.php?status_id=<?=$rsstatus['status_id']?>&act=edit" class="btn btn-outline-warning btn-sm" >เเก้ไข</a></i></td>
			<td align="center"><a href="status.php?status_id=<?=$rsstatus['status_id']?>&act=delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่');">ลบ</a></i>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>	
</div>