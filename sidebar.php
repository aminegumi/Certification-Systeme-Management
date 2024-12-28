<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="AdminIterface.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Home</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user3.png" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"> <?php echo $varnom . " " . $varprenom  ?> </h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">                    
                    <a href="AdminIterface.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Admin Space</a>
                    <a href="affectgroup1.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Assign Groups to teachers</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Show</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="ShowCourses.php" class="dropdown-item">Show Courses</a>
                            <a href="ShowGroups.php" class="dropdown-item">Show Groups</a>
                            <a href="ShowTeachers.php" class="dropdown-item">Show Teachers</a>
                            <a href="ShowMajors.php" class="dropdown-item">Show Sub Majors</a>
                            <a href="showstudentbyteacher.php" class="dropdown-item">Show Student of Teacher</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Add</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="AddTeacher.php" class="dropdown-item">Add Teacher</a>
                            <a href="AddTeachersExcel.php" class="dropdown-item">Add Teachers Excel</a>
                            <a href="AddMatiere.php" class="dropdown-item">Add Subject</a>
                            <a href="AddSubjectsExcel.php" class="dropdown-item">Add Subjects Excel</a>
                            <a href="AddStudent.php" class="dropdown-item">Add Student</a>
                            <a href="AddGroups.php" class="dropdown-item">Add Students Excel</a>
                            <a href="AddMajor.php" class="dropdown-item">Add major</a>
                            <a href="AddCourse.php" class="dropdown-item">Add Course</a>
                            <a href="AddProgress.php" class="dropdown-item">Add Progress</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->