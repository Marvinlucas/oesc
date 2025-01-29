<ul class="navbar-nav bg-pink sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <img class="logo" src="img/logo.png" alt="">
            </a>
            <div class="sidebar-brand-text mx-3">OESWC</div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php if($_SESSION['type'] == 1){ ?>
            <li class="nav-item active">
                <a class="nav-link" href="examiner_list.php">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Examiner List</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="exam_list.php">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Exam List</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="questionnaire_bank.php">
                    <i class="fa fa-list-ol"></i>
                    <span>Questionnaire Bank</span></a>
            </li>
            <?php }else{?>
                <li class="nav-item active">
                <a class="nav-link" href="exam_list.php">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Exam List</span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="questionnaire_bank.php">
                        <i class="fa fa-list-ol"></i>
                        <span>Questionnaire Bank</span></a>
                </li>
            <?php } ?>

        </ul>