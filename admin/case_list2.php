<?php
//query data
$queryCase = $condb->prepare("SELECT c.*, t.type_name , s.status_name , 
u.name as technicianName


FROM tbl_case as c
INNER JOIN tbl_type as t ON c.ref_type_id=t.type_id
INNER JOIN tbl_status as s ON c.ref_status_id=s.status_id
LEFT JOIN tbl_users as u ON c.ref_technician_id=u.id 
WHERE c.ref_status_id = 2
GROUP BY c.case_id
");
$queryCase->execute();
$rsCase= $queryCase->fetchAll();
?>
<h4>รายการซ่อมใหม่ กำลังดำเนินการซ่อม </h4>
<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped table-hover table-sm">
	<thead>
		<tr class="table table-info">
			<th width="5%">No.</th>
			<th width="5%">ห้อง</th>
			<th width="17%">อุปกรณ์</th>
			<th width="33%">รายละเอียด</th>
			<th width="15%">สถานะ</th>
			<th width="15%">การซ่อม</th>			
			<th width="10%">จบงาน</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($rsCase AS $row){ ?>
		<tr>

			<td><?=$row['case_id'];?></td>
			<td><?=$row['ref_room'];?></td>
			<td><?=$row['type_name']?></td>
			<td>
				<?=$row['detail']?> <br>
				วดป.ที่เเจ้ง <?=date('d/m/Y H:i:s' , strtotime($row['dateCreate']))?> น.
			</td>
			<td><?=$row['status_name']?></td>
			<td>
				ช่าง.<?=$row['technicianName']?>
				<br>
				วันที่เสร็จ.<?
				if ($row['caseCloseDate'] !=''){
				echo date('d/m/Y H:i:s' , strtotime($row['caseCloseDate']))
				?> 
			
			<td><a href="index.php?id=<?=$row['case_id'];?>&act=complete" class="btn btn-info btn-sm">จบงาน</a>
		</td>
			
		</tr>
		<?php } ?>
	</tbody>
</table>	
</div>