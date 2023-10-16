<?php
//query data
$stmttype = $condb->prepare("SELECT * FROM tbl_type");
$stmttype->execute();
$rstype= $stmttype->fetchAll();
?>
<h3 class="card-title">หมวดหมู่การเเจ้งซ่อม <a href="type.php?act=add" class="btn btn-primary btn-sm">+เพิ่มข้อมูล</a></h3>
<div class="table-responsive">
<table id="example2" class="table table-bordered table-striped table-hover table-sm">
	<thead>
		<tr class="table table-info">
			<th width="10%">ID</th>
			<th width="85%">ชื่อประเภท</th>
			<th width="5%">แก้ไข</th>
			<th width="5%">ลบ</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($rstype AS $rstype){ ?>
		<tr>
			<td><?= $i++;?></td>
			<td><?=$rstype['type_name']?></td>
			<td align="center"><a href="type.php?type_id=<?=$rstype['type_id']?>&act=edit" class="btn btn-outline-warning btn-sm" >เเก้ไข</a></i></td>
			<td align="center"><a href="type.php?type_id=<?=$rstype['type_id']?>&act=delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่');">ลบ</a></i>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>	
</div>