<?php 
include 'header.php';
include 'nav.php';
include 'sidebar_menu.php';

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>จัดการข้อมูล Admin/ช่าง</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <?php 
                 $act = (isset($_GET['act']) ? $_GET['act'] : '');
                  if($act == 'add'){
                    include 'admin_form_add.php';
                  }else if($act == 'delete'){
                    include 'admin_delete.php';
                  }else if($act == 'edit'){
                    include 'admin_form_edit.php';
                  }else if($act == 'password'){
                    include 'admin_form_edit_password.php';
                  }else{
                    include 'admin_list.php';
                    
                  }
                ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php';?>