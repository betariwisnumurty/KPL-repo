<style>
  .skin-blue .sidebar-menu>li:hover>a,
  .skin-blue .sidebar-menu>li.active>a,
  .skin-blue .sidebar-menu>li.menu-open>a
  {
    color: #fff;
    background: #1a4f5c;
  }
.main-sidebar .sidebar .sidebar-menu li{
  color: white;
}
.main-sidebar .sidebar .sidebar-menu a{
  color: white;
}
.main-sidebar .sidebar .sidebar-menu .header{
  background-color: #22363C !important
}
.skin-blue .sidebar-menu>li.active>a {
    border-left-color: #50bf54;
}
</style>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a>Admin</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">LAPORAN</li>
        <li class=""><a href="home.php"><i class="fa fa-bar-chart"></i> <span>Dasbor</span></a></li>
        <li class="header">KELOLA</li>

        <li><a href="attendance.php"><i class="fa fa-check-square-o"></i> <span>Presensi</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Karyawan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="employee.php"><i class="fa fa-circle-o"></i> Daftar Karyawan</a></li>
            <li><a href="cashadvance.php"><i class="fa fa-circle-o"></i> Kasbon Karyawan</a></li>
            <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Jadwal Karyawan</a></li>
          </ul>
        </li>
        <li><a href="deduction.php"><i class="fa fa-credit-card-alt"></i> <span>Potongan</span></a></li>
        <li><a href="position.php"><i class="fa fa-suitcase"></i> <span>Jabatan</span></a></li>
        <li class="header">CETAK</li>
        <li><a href="payroll.php"><i class="fa fa-files-o"></i> <span>Daftar Gaji Karyawan</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
