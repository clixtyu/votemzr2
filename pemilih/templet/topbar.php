

<!-- Sidebar -->
<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #34495e">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
    <div class="sidebar-brand-icon">
      <i class="fas fa-poll"></i>
    </div>
    <div class="sidebar-brand-text mx-3">E-VOTING</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="dashboard.php?title=Dashboard - eVoting OSIS">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
      <!--   <div class="sidebar-heading">
          Interface
        </div> -->


        <!-- Nav Item - voting -->
        <li class="nav-item">
          <a class="nav-link" href="voting.php?title=Voting - eVoting OSIS">
            <i class="fas fa-check-double"></i>
            <span>Voting</span></a>
          </li>
          <!-- Divider -->
          <hr class="sidebar-divider">
          <!-- Nav Item - ganti password -->
          <li class="nav-item">
            <a class="nav-link" href="ganti_password.php?title=Ganti Password - eVoting OSIS">
              <i class="fas fa-key"></i>
              <span>Ganti Password</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

              <!-- Sidebar Toggler (Sidebar) -->
              <div class="text-center d-none d-md-inline" style="float: center">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
             </div>

           </ul>
           <!-- End of Sidebar -->

           <!-- Content Wrapper -->
           <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

             <!-- Topbar -->
             <nav class="navbar navbar-expand navbar-light bg-grey topbar mb-3 static-top shadow">

              <!-- Sidebar Toggle (Topbar) -->
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
               <i class="fa fa-bars"></i>
             </button>


             <!-- Topbar Navbar -->
             <ul class="navbar-nav ml-auto">

               <!-- Nav Item - Search Dropdown (Visible Only XS) -->
               <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
              aria-labelledby="searchDropdown">
              <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                 <input type="text" class="form-control bg-light border-0 small"
                 placeholder="Search for..." aria-label="Search"
                 aria-describedby="basic-addon2">
                 <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                   <i class="fas fa-search fa-sm"></i>
                 </button>
               </div>
             </div>
           </form>
         </div>
       </li>




       <div class="topbar-divider d-none d-sm-block"></div>

       <!-- Nav Item - User Information -->
       <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username'] ?></span>
        <i class="fas fa-user"></i>

      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
      aria-labelledby="userDropdown">
      <a class="dropdown-item" href="seting_profil.php?title=Profil - eVoting OSIS">
        <i class="fas fa-user fa-sm fa-fw mr-2"></i>
         Profil
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" onclick="return confirm('Yakin mau keluar?')" href="logout.php">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
        Logout
      </a>
    </div>
  </li>

</ul>

</nav>
<!-- End of Topbar -->

