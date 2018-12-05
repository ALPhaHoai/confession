<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách confession</title>
    <?php
    include __DIR__ . "/include/head.php";
    ?>
</head>

<body>

<div id="wrapper">
    <?php
    include __DIR__ . "/include/header.php";
    ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Truyện
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-list"></i> Danh sách
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="order-by" style="margin-bottom: 20px">
                        <span>Sắp xếp theo:</span>
                        <span>
                            <select id="order_field" class="selectpicker show-tick" data-width="auto">
                                <option value="id">Id</option>
                                <option value="date_created">Ngày tạo</option>
                                <option value="approval">Trạng thái phê duyệt</option>
                                <option value="cmt">Số lượng comment</option>
                                <option value="like">Số lượng like</option>
                                <option value="dislike">Số lượng dislike</option>
                                <option value="view">Số lượng view</option>
                            </select>
                        </span>
                        <span>
                            <select id="order_by" class="selectpicker show-tick" data-width="auto">
                                <option value="asc">Tăng dần</option>
                                <option value="desc">Giảm dần</option>
                            </select>
                        </span>
                        <span>
                            <button class="btn btn-primary" onclick="getPosts(0)">Lọc</button>
                        </span>
                    </div>
                </div>
            </div>
            <div id="search-result">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nội dung</th>
                                <th>Trạng thái phê duyệt</th>
                                <th>Comment</th>
                                <th>Like</th>
                                <th>Disklike</th>
                                <th>View</th>
                                <th>Ngày tạo</th>

                                <th>Phê duyệt</th>
                                <th>Không phê duyệt</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        getPosts(start);
                        $(window).scroll(function () {
                            if ($(window).scrollTop() + $(window).height() > $(document).height() - 300) {
                                if (moreResult && !pending)
                                    getPosts(start);
                            }
                        });
                    });
                </script>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <?php
    include __DIR__ . "/include/footer.php";
    ?>
</div>

</body>

</html>



