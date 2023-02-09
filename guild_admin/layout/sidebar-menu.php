<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image text-white">
            <i class="fas fa-user-circle fa-2x"></i>
        </div>
        <div class="info">
            <!-- ชื่อแอดมิน Username Admin -->
            <a href="index.php?mn=system&file=system_list" class="d-block"><?= $_SESSION['user_admin'] ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
            if ($_GET['mn'] == 'dashboard' || $_GET['mn'] == '') {
                $dash_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=dashboard&file=dashboard_list" class="nav-link <?= $dash_active ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        ภาพรวม
                    </p>
                </a>
            </li>

            <?php
            if ($_GET['mn'] == 'hall') {
                $hall_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=hall&file=hall_list" class="nav-link <?= $hall_active ?>">
                    <i class="nav-icon fas fa-chess"></i>
                    <p>
                        บันทึกแห่งเกียรติยศ
                    </p>
                </a>
            </li>
            <?php
            if ($_GET['mn'] == 'hall_left') {
                $hall_left_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=hall_left&file=hall_left_list" class="nav-link <?= $hall_left_active ?>">
                    <i class="nav-icon fas fa-dungeon"></i>
                    <p>
                        Origin Quest
                    </p>
                </a>
            </li>

            <?php
            if ($_GET['mn'] == 'hall_right') {
                $hall_right_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=hall_right&file=hall_right_list" class="nav-link <?= $hall_right_active ?>">
                    <i class="nav-icon fas fa-dungeon"></i>
                    <p>
                        Hall of Fame
                    </p>
                </a>
            </li>

            <?php
            if ($_GET['mn'] == 'quest') {
                $quest_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=quest&file=quest_list" class="nav-link <?= $quest_active ?>">
                    <i class="nav-icon fas fa-scroll"></i>
                    <p>
                        ภารกิจ
                    </p>
                </a>
            </li>

            <?php
            if ($_GET['mn'] == 'categories') {
                $categories_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=categories&file=categories_list" class="nav-link <?= $categories_active ?>">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>
                        ประเภทภาระกิจ
                    </p>
                </a>
            </li>

            <?php
            if ($_GET['mn'] == 'banner') {
                $banner_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=banner&file=banner_list" class="nav-link <?= $banner_active ?>">
                    <i class="nav-icon fas fa-ad"></i>
                    <p>
                        โฆษณา
                    </p>
                </a>
            </li>

            <?php
            if ($_GET['mn'] == 'pages') {
                $pages_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=pages&file=pages_list" class="nav-link <?= $pages_active ?>">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        Phase, Road Map&Tutorial
                    </p>
                </a>
            </li>
             <?php
            if ($_GET['mn'] == 'About') {
                $About_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=About&file=pages_list" class="nav-link <?= $About_active ?>">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                       About Boukensha
                    </p>
                </a>
            </li>
             <?php
            if ($_GET['mn'] == 'Rules') {
                $Rules_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=Rules&file=pages_list" class="nav-link <?= $Rules_active ?>">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        Rules & Order
                    </p>
                </a>
            </li>

            <?php
            if ($_GET['mn'] == 'blog_type' or $_GET['mn'] == 'blog' or $_GET['mn'] == 'tags' or $_GET['mn'] == 'author') {
                $type_show = main_active();
                $type_active = sub_active();
            }
            ?>
            <li class="nav-item <?= $type_show ?>">
                <a href="#" class="nav-link <?= $type_active ?>">
                    <i class="nav-icon fab fa-blogger"></i>
                    <p>
                        บทความ
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <?php
                if ($_GET['file'] == 'blog_type_list' || $_GET['file'] == 'blog_type_add' || $_GET['file'] == 'blog_type_edit' || $_GET['file'] == 'blog_type_detail') {
                    $blog_type_active = sub_active();
                    $blog_type_show = display_show();
                }
                ?>
                <ul class="nav nav-treeview">
                    <?php
                    if ($_GET['file'] == 'blog_list' || $_GET['file'] == 'blog_add' || $_GET['file'] == 'blog_edit' || $_GET['file'] == 'blog_detail') {
                        $blog_active = sub_active();
                        $blog_show = display_show();
                    }
                    ?>
                    <li class="nav-item" <?= $blog_show ?>>
                        <a href="index.php?mn=blog&file=blog_list" class="nav-link <?= $blog_active ?>">
                            <i class="far fa-newspaper nav-icon"></i>
                            <p>บทความ</p>
                        </a>
                    </li>
                    <li class="nav-item" <?= $blog_type_show ?>>
                        <a href="index.php?mn=blog_type&file=blog_type_list" class="nav-link <?= $blog_type_active ?>">
                            <i class="far fa-list-alt nav-icon"></i>
                            <p>ประเภทบทความ</p>
                        </a>
                    </li>
                    <?php
                    if ($_GET['file'] == 'tags_list' || $_GET['file'] == 'tags_add' || $_GET['file'] == 'tags_edit' || $_GET['file'] == 'tags_detail') {
                        $tags_active = sub_active();
                        $tags_show = display_show();
                    }
                    ?>
                    <li class="nav-item" <?= $tags_show ?>>
                        <a href="index.php?mn=tags&file=tags_list" class="nav-link <?= $tags_active ?>">
                            <i class="fas fa-tags nav-icon"></i>
                            <p>ป้ายกำกับ</p>
                        </a>
                    </li>
                    <?php
                    if ($_GET['file'] == 'author_list' || $_GET['file'] == 'author_add' || $_GET['file'] == 'author_edit' || $_GET['file'] == 'author_detail') {
                        $author_active = sub_active();
                        $author_show = display_show();
                    }
                    ?>
                    <li class="nav-item" <?= $author_show ?>>
                        <a href="index.php?mn=author&file=author_list" class="nav-link <?= $author_active ?>">
                            <i class="fas fa-user-edit nav-icon"></i>
                            <p>ผู้แต่ง</p>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
            if ($_GET['mn'] == 'category') {
                $category_active = sub_active();
            }
            ?>
            <!-- <li class="nav-item">
                <a href="index.php?mn=category&file=category_list" class="nav-link <?= $category_active ?>">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>
                        ประเภทสินค้า
                    </p>
                </a>
            </li> -->
            <?php
            if ($_GET['mn'] == 'product') {
                $product_active = sub_active();
            }
            ?>
            <!-- <li class="nav-item">
                <a href="index.php?mn=product&file=product_list" class="nav-link <?= $product_active ?>">
                    <i class="nav-icon fas fa-store"></i>
                    <p>
                        สินค้า
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        ออเดอร์
                    </p>
                </a>
            </li> -->
            <?php
            if ($_GET['mn'] == 'location') {
                $location_open = main_active();
                $location_active = sub_active();
                $location_display_location = display_show();
            }
            ?>
            <li class="nav-item <?= $location_open ?>">
                <a href="#" class="nav-link <?= $location_active ?>">
                    <i class="nav-icon fas fa-map-marked-alt"></i>
                    <p>
                        ฐานข้อมูลจังหวัด
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <?php
                if ($_GET['file'] == 'provinces_list') {
                    $provinces_active = sub_active();
                }
                ?>
                <?php
                if ($_GET['file'] == 'districts_list') {
                    $districts_active = sub_active();
                }
                ?>
                <?php
                if ($_GET['file'] == 'districts_list') {
                    $districts_active = sub_active();
                }
                ?>
                <?php
                if ($_GET['file'] == 'subdistricts_list') {
                    $subdistricts_active = sub_active();
                }
                ?>
                <ul class="nav nav-treeview" <?= $location_display_location ?>>
                    <li class="nav-item">
                        <a href="index.php?mn=location&file=provinces_list" class="nav-link <?= $provinces_active ?>">
                            <i class="fas fa-map-marker-alt nav-icon"></i>
                            <p>จังหวัด</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?mn=location&file=districts_list" class="nav-link <?= $districts_active ?>">
                            <i class="fas fa-map-marker-alt nav-icon"></i>
                            <p>อำเภอ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?mn=location&file=subdistricts_list" class="nav-link <?= $subdistricts_active ?>">
                            <i class="fas fa-map-marker-alt nav-icon"></i>
                            <p>ตำบล</p>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
            if ($_GET['mn'] == 'contact') {
                $contact_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=contact&file=contact_list" class="nav-link <?= $contact_active ?>">
                    <i class="nav-icon far fa-envelope"></i>
                    <p>
                        ติดต่อเรา
                    </p>
                </a>
            </li>
            <?php
            if ($_GET['mn'] == 'member') {
                $member_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=member&file=member_list" class="nav-link <?= $member_active ?>">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        สมาชิก
                    </p>
                </a>
            </li>
            <?php
            if ($_GET['mn'] == 'system') {
                $system_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=system&file=system_list" class="nav-link <?= $system_active ?>">
                    <i class="nav-icon fas fa-user-lock"></i>
                    <p>
                        ผู้ดูแลระบบ
                    </p>
                </a>
            </li>

            <?php
            if ($_GET['mn'] == 'setting') {
                $setting_active = sub_active();
            }
            ?>
            <li class="nav-item">
                <a href="index.php?mn=setting&file=setting_list" class="nav-link <?= $setting_active ?>">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        ตั้งค่า
                    </p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>