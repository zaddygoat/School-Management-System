<!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="<?=$base_url?>/schoolmanagementproject.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="../dist/assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Student Panel</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2" aria-label="Main navigation">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column"
    data-lte-toggle="treeview"
    data-accordion="false">

    <!-- Dashboard -->
    <li class="nav-item">
        <a href="<?=$base_url?>student/dashboard.php" class="nav-link">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Student Dashboard</p>
        </a>
    </li>

    <!-- Manage Class Routines -->
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-calendar3"></i>
            <p>
                View Timetable
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?=$base_url?>student/view_subjects.php" class="nav-link"><p>View Subjects</p></a></li>
            <li class="nav-item"><a href="<?=$base_url?>student/view_timetable.php" class="nav-link"><p>View Time Table</p></a></li>
        </ul>
    </li>

    <!-- Manage Examinations -->
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-file-earmark-text"></i>
            <p>
                VIew Examinations
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?=$base_url?>student/exam.php" class="nav-link"><p>Exams</p></a></li>
            <li class="nav-item"><a href="<?=$base_url?>student/grades.php" class="nav-link"><p>Grades</p></a></li>
            <li class="nav-item"><a href="<?=$base_url?>student/marks.php" class="nav-link"><p>Marks</p></a></li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-calendar-check"></i>
            <p>
                View Attendance
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?=$base_url?>student/attendance.php" class="nav-link"><p>Attendance</p></a></li>        </ul>
    </li>
	<li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-calendar-check"></i>
            <p>
                Fees
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?=$base_url?>student/fee_details.php" class="nav-link"><p>Fee Details</p></a></li>
        </ul>
    </li>
	<li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-calendar-check"></i>
            <p>
                Study Materials
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?=$base_url?>student/study_materials.php" class="nav-link"><p>Study Materials</p></a></li>
         </ul>
    </li>
            </nav>
        </div>
        <!-- /.sidebar-wrapper -->
    </aside>
    <!-- /.app-sidebar -->

    <main class="app-main">