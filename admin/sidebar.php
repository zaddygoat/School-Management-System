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
            <span class="brand-text fw-light">Admin</span>
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
        <a href="<?=$base_url?>admin/dashboard.php" class="nav-link">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Dashboard</p>
        </a>
    </li>

    <!-- Manage Accounts -->
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-people-fill"></i>
            <p>
                Manage Accounts
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
		
			<li class="nav-item">
                <a href="<?=$base_url?>admin/counsellor.php" class="nav-link">
                    <p>Counsellor</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=$base_url?>admin/teachers.php" class="nav-link">
                    <p>Teachers</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=$base_url?>admin/students.php" class="nav-link">
                    <p>Students</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=$base_url?>admin/parents.php" class="nav-link">
                    <p>Parents</p>
                </a>
            </li>
        </ul>
    </li>

    <!-- Manage Classes -->
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-building"></i>
            <p>
                Manage Classes
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?=$base_url?>admin/classes.php" class="nav-link"><p>Classes</p></a></li>
            <li class="nav-item"><a href="<?=$base_url?>admin/courses.php" class="nav-link"><p>Courses</p></a></li>
            <li class="nav-item"><a href="<?=$base_url?>admin/sections.php" class="nav-link"><p>Sections</p></a></li>
            <li class="nav-item"><a href="<?=$base_url?>admin/subjects.php" class="nav-link"><p>Subjects</p></a></li>        </ul>
    </li>

    <!-- Manage Class Routines -->
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-calendar3"></i>
            <p>
                Manage Timetable
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?=$base_url?>admin/view_subjects.php" class="nav-link"><p>View Subjects</p></a></li>
            <li class="nav-item"><a href="<?=$base_url?>admin/time_table.php" class="nav-link"><p>Time Table</p></a></li>
            <li class="nav-item"><a href="<?=$base_url?>admin/view_timetable.php" class="nav-link"><p>View Time Table</p></a></li>
        </ul>
    </li>

    <!-- Manage Attendance -->
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-calendar-check"></i>
            <p>
                Manage Attendance
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?=$base_url?>admin/attendance.php" class="nav-link"><p>Student Attendance</p></a></li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-cash-stack"></i>
            <p>
                Manage Fees
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?=$base_url?>admin/student_fees.php" class="nav-link"><p>Student Fees</p></a></li>
        </ul>
    </li>
</ul>
            </nav>
        </div>
        <!-- /.sidebar-wrapper -->
    </aside>
    <!-- /.app-sidebar -->

    <main class="app-main">