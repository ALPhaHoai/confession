<?php
session_start();

if (isset($_SESSION['login']['success']) && $_SESSION['login']['success']) {
    require_once __DIR__ . "/class/admin.php";
    $id = $_SESSION['login']['id'];

    $admin = new admin($id);

    $totalNotYetApproval = $admin->getTotalPostNotYetApproval();

} else {
    unset($_SESSION['login']);
    header("location:/admin/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Thống kê
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="public/css/material-dashboard.css?v=2.1.0" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
</head>

<body class="">
<div class="wrapper ">
    <?php
    include __DIR__ . "/include/sidebar.php";
    ?>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <form class="navbar-form">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="material-icons">dashboard</i>
                                <p class="d-lg-none d-md-block">
                                    Stats
                                </p>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">notifications</i>
                                <?php
                                if ($totalNotYetApproval > 0) echo '<span class="notification">' . $totalNotYetApproval . '</span>';
                                ?>
                                <p class="d-lg-none d-md-block">
                                    Some Actions
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <?php
                                if ($totalNotYetApproval > 0) echo '<a class="dropdown-item" href="#">Bạn có ' . $totalNotYetApproval . ' bài viết cần phê duyệt</a>';
                                ?>

                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <p class="card-category">Số bài viết</p>
                                <h3 class="card-title"><?php echo $admin->getTotalPost() ?>
                                    <small>bài</small>
                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="javascript: getAllPost();">Xem hết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <p class="card-category">Số bài 24h qua</p>
                                <h3 class="card-title"><?php echo $admin->getTotalPost24h() ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="#">Xem hết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <p class="card-category">Bài chưa phê duyệt</p>
                                <h3 class="card-title"><?php echo $totalNotYetApproval ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="#">Xem hết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <p class="card-category">Số bài nổi bật gần đây</p>
                                <h3 class="card-title">45</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="#">Xem hết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12" id="result" style="display: none">
                        <div class="card">
                            <div class="card-header card-header-warning">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-category">Card title 2</p>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover" id="table-result">
                                    <thead class="text-warning">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian phê duyệt</th>
                                        <th>Người phê duyệt</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div id="load-more-post" onclick="alert('clicked')"
                                 style="padding: 12px; text-align: center;"><a>Xem thêm</a></div>
                        </div>
                    </div>
                    <?php
                    $recentlyApprovedPosts = $admin->getRecentlyPostApproved();
                    if (is_array($recentlyApprovedPosts) && count($recentlyApprovedPosts) > 0) {
                        ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-warning">
                                    <h4 class="card-title">Vừa được phê duyệt gần đây</h4>
                                    <p class="card-category">Số bài vừa được phe duyệt</p>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                        <th>ID</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian phê duyệt</th>
                                        <th>Người phê duyệt</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($recentlyApprovedPosts as $recentlyPost) {
                                            ?>
                                            <tr>
                                            <td><?= $recentlyPost->id ?></td>
                                            <td><?php
                                                if (strlen($recentlyPost->content) > 200) {
                                                    echo substr($recentlyPost->content, 0, 200) . "...";
                                                } else echo $recentlyPost->content;
                                                ?></td>
                                            <td><?= $recentlyPost->approval_time ?></td>
                                            <td><?= $recentlyPost->approval_by_name ?></td>
                                            </tr><?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $recentlyNotYetApprovalPosts = $admin->getRecentlyPostNotYetApproval();
                    if (is_array($recentlyNotYetApprovalPosts) && count($recentlyNotYetApprovalPosts) > 0) {
                        ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-warning">
                                    <h4 class="card-title">Chưa được phê duyệt</h4>
                                    <p class="card-category">Số bài chưa được phe duyệt</p>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                        <th>ID</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian đăng</th>
                                        <th>Số bài user đã đăng</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($recentlyNotYetApprovalPosts as $recentlyPost) {
                                            ?>
                                            <tr>
                                            <td><?= $recentlyPost->id ?></td>
                                            <td><?php
                                                if (strlen($recentlyPost->content) > 200) {
                                                    echo substr($recentlyPost->content, 0, 200) . "...";
                                                } else echo $recentlyPost->content;
                                                ?></td>
                                            <td><?= $recentlyPost->date_created ?></td>
                                            <td><?= $recentlyPost->num_user_post ?></td>
                                            </tr><?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="public/js/core/jquery.min.js" type="text/javascript"></script>
<script src="public/js/core/popper.min.js" type="text/javascript"></script>
<script src="public/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="public/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="public/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="public/js/plugins/bootstrap-notify.js"></script>
<!-- Control public for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="public/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

    });

    function getAllPost(page = 0) {
        $.ajax({
            url: "./ajax/main.php?type=all%20post&page=" + page,
            type: 'GET',
            dataType: 'json',
            headers: {
                'Content-Type': 'application/json',
            },
            complete: function (response) {
                console.log(response);
                if (response.status === 200) {
                    buildPost(response.responseJSON);
                } else {
                }
            }
        });
    }

    function buildPost(posts) {
        if ((typeof posts).toLowerCase() !== "object" || posts == null || posts.length === 0) return;

        $("#result").show();
        $("#table-result tr").remove();
        for (var i = 0; i < posts.length; i++) {
            $("#table-result").append("<tr id=\"" + posts[i].id + "\">" +
                "<td class=\"result-id\">" + posts[i].id + "</td>" +
                "<td class=\"result-content\">" + ((posts[i].content.length > 200) ? (posts[i].content.substr(0, 200) + "...") : posts[i].content) + "</td>" +
                "<td class=\"result-time-approval\">" + posts[i].approval_time + "</td>" +
                "<td class=\"result-approval-by\">" + posts[i].approval_by + "</td>" +
                "</tr>");
        }
    }
</script>
</body>

</html>