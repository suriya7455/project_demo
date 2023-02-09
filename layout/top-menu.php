<header class="header">
    <div class="top-bar">
        <div class="content-topbar flex-sb-m h-full container">
            <div class="text-white text-right py-1">
                <?php
                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                ?>
                <a class="btn btn-dark" href="https://translate.google.com/translate?sl=th&tl=en&u=<?= $actual_link ?>" target="_blank"><i class="fas fa-language"></i> TH-ENG</a>
                <div><small>จำนวนผู้ใช้บริการ <?= number_format($strToday) ?> คน</small></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="index.php">
                        <!-- <img src="img/logo.png" alt=""> -->
                        <span class="h5 text-white">Boukensha</span> <span class="h5 text-danger">Guild</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="#">Guild Board</a>
                                <ul class="dropdown">
                                    <li><a href="guild-board.php">Guild Board</a></li>
                                    <li><a href="new-quest.php">New Quest</a></li>
                                    <li><a href="last-completed-quest.php">Last Complete Quest</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Group Party</a>
                                <ul class="dropdown">
                                    <li><a href="#">New Group</a></li>
                                    <li><a href="#">Join Group</a></li>
                                </ul>
                            </li>
                            <li><a href="blog.php">Guild Blog</a></li>
                            <?php
                            $sql_pages0 = " SELECT * FROM pages WHERE pages_type = '0'  ORDER BY id ASC  ";
                            $result_pages0 = mysqli_query($conn, $sql_pages0);
                            $rs_pages0 = mysqli_fetch_assoc($result_pages0);
                            ?>
                            <li><a href="pages.php?id=<?= $rs_pages0['id'] ?>">Phase, Road Map&Tutorial</a>
                                <ul class="dropdown">
                                    <?php
                                    $sql_pages1 = " SELECT * FROM pages WHERE pages_type = '0' ORDER BY id ASC ";
                                    $result_pages1 = mysqli_query($conn, $sql_pages1);
                                    while ($rs_pages1 = mysqli_fetch_assoc($result_pages1)) {
                                    ?>
                                        <li><a href="pages.php?id=<?= $rs_pages1['id'] ?>"><?= $rs_pages1['pages_name'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a href="#">About Boukensha</a>
                                <ul class="dropdown">
                                    <?php
                                    $sql_pages2 = " SELECT * FROM pages  WHERE pages_type = '1' ORDER BY id ASC  ";
                                    $result_pages2 = mysqli_query($conn, $sql_pages2);
                                    while ($rs_pages2 = mysqli_fetch_assoc($result_pages2)) {
                                    ?>
                                        <li><a href="pages.php?id=<?= $rs_pages2['id'] ?>"><?= $rs_pages2['pages_name'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>

                            <li><a href="#">Rules & Order</a>
                                <ul class="dropdown">
                                    <?php
                                    $sql_pages2 = " SELECT * FROM pages  WHERE pages_type = '2' ORDER BY id ASC  ";
                                    $result_pages2 = mysqli_query($conn, $sql_pages2);
                                    while ($rs_pages2 = mysqli_fetch_assoc($result_pages2)) {
                                    ?>
                                        <li><a href="pages.php?id=<?= $rs_pages2['id'] ?>"><?= $rs_pages2['pages_name'] ?></a></li>
                                    <?php } ?> 
                                </ul>
                            </li>
                            <?php if (isset($_SESSION['guild_member'])) {
                                # code...
                            if ($_SESSION['guild_member'] != "" && $_SESSION['guild_member_login'] === true) { ?>
                                <li><a href="#">Login</a>
                                    <ul class="dropdown">
                                        <li><a href="member_guild.php?mn=profile&file=profile_list">User Profile</a></li>
                                        <li><a href="member_guild.php?mn=quest&file=quest_active">Active Quest</a></li>
                                        <li><a href="member_guild.php?mn=quest&file=quest_complete">Complete Quest</a></li>
                                        <li><a href="javascript:;" onclick="logouts('logout.php')">Log out</a></li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li><a href="#">Login</a>
                                    <ul class="dropdown">
                                        <li><a href="signup.php">Signup</a></li>
                                        <li><a href="login.php">Login</a></li>
                                        <li><a href="guild_admin/">Guild Admin</a></li>
                                    </ul>
                                </li>
                            <?php }   }else{  ?>
                                <li><a href="#">Login</a>
                                    <ul class="dropdown">
                                        <li><a href="signup.php">Signup</a></li>
                                        <li><a href="login.php">Login</a></li>
                                       <!--  <li><a href="guild_admin/">Guild Admin</a></li> -->
                                    </ul>
                                </li>
                        <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-1">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                    <!-- <a href="./login.html"><span class="icon_profile"></span></a> -->
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>