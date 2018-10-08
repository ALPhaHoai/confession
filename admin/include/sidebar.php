<?php
/**
 * Created by PhpStorm.
 * User: Long
 * Date: 10/5/2018
 * Time: 2:49 PM
 */
?>
<div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a class="simple-text logo-normal">
                <?php echo (isset($admin->name)) ? $admin->name : "Error" ?>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item active  ">
                    <a class="nav-link" href="/admin/dashboard.php">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/admin/user.php">
                        <i class="material-icons">person</i>
                        <p>Thông tin người dùng</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/admin/posts.php">
                        <i class="material-icons">content_paste</i>
                        <p>Danh sách bài viết</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/admin/notifications.html">
                        <i class="material-icons">notifications</i>
                        <p>Thông báo</p>
                    </a>
                </li>
                <!-- <li class="nav-item active-pro ">
                      <a class="nav-link" href="./upgrade.html">
                          <i class="material-icons">unarchive</i>
                          <p>Upgrade to PRO</p>
                      </a>
                  </li> -->
            </ul>
        </div>
    </div>