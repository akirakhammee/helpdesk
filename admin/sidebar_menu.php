<!-- Main Sidebar Container  change bgcolor add style="background-color: green;" -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">สวัสดี <?=$_SESSION['name'];?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                หน้าหลัก
              </p>
            </a>
          </li>


          <!-- <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                จัดการงานซ่อม
              </p>
            </a>
          </li> -->


          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                จัดการสมาชิก
              </p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="user.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                จัดการ Users
              </p>
            </a>
          </li> -->


          <li class="nav-item">
            <a href="type.php" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                จัดการประเภท
              </p>
            </a>
          </li>

        

          <li class="nav-item">
            <a href="status.php" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                จัดการสถานะ
              </p>
            </a>
          </li>


    
          <!-- <li class="nav-item">
            <a href="form.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Form Summer Note
              </p>
            </a>
          </li> -->

          
        

           <li class="nav-item">
            <a href="../logout.php" class="nav-link" onclick="return confirm('ยืนยันการออกจากระบบ?');">
               <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
               ออกจากระบบ
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>