<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <a href="#" class="logo"><b>Admin Dashboard</b></a>
    <div class="nav notify-row" id="top_menu">



        </ul>
    </div>
    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>
<aside>
    <div id="sidebar" class="nav-collapse ">
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href="#"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
            <h5 class="centered"><?php echo $_SESSION['login']; ?></h5>

            <!-- <li class="mt">
                      <a href="change-password.php">
                          <i class="fa fa-file"></i>
                          <span>Change Password</span>
                      </a>
                  </li> -->

            <li class="sub-menu">
                <a href="manage-users.php">
                    <i class="fa fa-users"></i>
                    <span>Manage Users</span>
                </a>

            </li>


        </ul>
    </div>
</aside>