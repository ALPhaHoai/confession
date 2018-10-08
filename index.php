<?php
/**
 * Created by PhpStorm.
 * User: Long
 * Date: 9/28/2018
 * Time: 10:13 AM
 */
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/db.php";

require_once __DIR__ . "/class/comment.php";
require_once __DIR__ . "/class/post.php";
require_once __DIR__ . "/class/user.php";

$CurrentPageType = "Confession";
$main_page_title = "Confession";

if(isset($_GET['id'])){
    $post =  new post($_GET['id']) ;
} else $post = new post();


if($post->getProperties() && $post->isApproved()){
    $comments = $post->getComments();
} else unset($post);


?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Confession - Anigoo</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<link rel="stylesheet" type="text/css" href="/confession/public/style.css">
<div class="main">
    <div class="container">
        <div class="goo-white-card-has-padding">
            <div class="header">
                <ul class="nav nav-pills pull-right">
<!--                    <li><a onclick="javascript:(document.getElementById('feed')) ? window.location.href='/confession/' + (parseInt(confessionId) + 1) : alert('Không có confession tiếp đâu!')">Tiếp</a></li>-->
                    <li><a href="/confession">Xem</a></li>
                    <li><a onclick="javascript:alert('Tính năng đang trong quá trình phát triển');">Thêm</a></li>
                    <li><a onclick="javascript:alert('Tell me your secret!');">Thông tin</a></li>
                </ul>
                <h4>Hãy thú tội đi nào</h4>
            </div>
            <div style=" font-size: 12px;">Chúng tôi không lưu bất cứ thông tin gì của bạn ngoại trừ những gì bạn viết
                dưới đây.
            </div>
            <br>
            <br>
            <?php
            if (isset($post) && $post !== null) {
                ?>
                <div id="feed" class="_4-u2  _4mrt _5v3q" confession_id="<?php echo $post->id ?>">
                    <div class=" _4pu6">
                        <div class="_1dwg _1w_m _q7o">
                            <div class="clearfix">Được tạo vào
                                ngày: <?php echo $post->date_created->format('d/m/Y'); ?>
                            </div>
                            <div class="_5pbx  _3ds9">
                                <div class="text-content <?php echo (strlen($post->content) < 100) ? 'big-text-content' : 'text-content'?>">
                                    <p><?php echo $post->getContent(); ?></p></div>
                            </div>
                        </div>
                        <div>
                            <div class="_sa_  _fgm _5vsi _192z _1sz4 _1i6z">
                                <div class="_37uu">
                                    <div class="_3399 _1f6t _4_dr _20h5">
                                        <div class="count-comments">
                                            <a class="total-comment-text"><span
                                                        id="total-comment"><?php echo (isset($comments) && isset($comments['total']) && is_numeric($comments['total'])) ? $comments['total'] : 0; ?></span>
                                                Bình luận</a>
                                        </div>
                                        <div class="_4ar- _ipn count-reactions">
                                                <span class="count-like-reaction count-reaction">
                                                    <a class="_3emk _401_"><i class="count-reaction-icon "></i></a>
                                                    <span id="total-like"><?= $post->like ?></span>
                                                </span>
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <span class="count-dislike-reaction count-reaction ">
                                                    <a class="_3emk _401_"><i class="count-reaction-icon "
                                                                              style="transform: rotate(180deg);"></i></a>
                                                    <span id="total-dislike"><?= $post->dislike ?></span>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="_3399 _a7s _20h6 _610i _610j _125r _2h27 clearfix _zw3">
                                        <div class="_524d">
                                            <div class="_42nr _1mtp">
                                                <a class="reaction-button  like-button" onclick="doPostReaction('like');">
                                                    <span>Like</span>
                                                </a>
                                                <a class="reaction-button  dislike-button" onclick="doPostReaction('dislike');">
                                                    <span>Dislike</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="_3-a6  _65_9 all-comment">
                                <?php
                                if (isset($comments) && isset($comments['comments']) && is_array($comments['comments']) && count($comments['comments']) > 0) {
                                    for ($i = 0; $i < count($comments['comments']); $i++) {
                                        ?>
                                        <div class="UFIComment <?php if ($i == 0) echo "first-comment"; ?>"
                                             comment_id= "<?php echo $post->id . "_" . $comments['comments'][$i]->id ?>"
                                        <?php if($i >= LIMIT_COMMENT_PER_CONFESSION/2) echo "style=\"display: none\"";?>
                                        >
                                            <div class="lfloat">
                                                <a class="UFICommentAuthorWithPresence img _8o _8s UFIImageBlockImage">
                                                    <img class="avatar" style="width:32px;height:32px;"
                                                         src="data:image/png;base64,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">
                                                    <div class="UFICommentAuthorPresence"></div>
                                                </a>
                                            </div>
                                            <div class="UFIImageBlockContent _42ef">
                                                <div class="">
                                                    <div class="UFICommentContentBlock">
                                                        <div class="UFICommentContent">
                                                            <div class="_26f8">
                                                                <span class=" UFICommentActorAndBody">
                                                                    <div class="UFICommentActorAndBodySpacing">
                                                                        <span><a class=" UFICommentActorName"><?php echo $comments['comments'][$i]->date_created->format('d/m/Y'); ?></a></span>
                                                                        <span>:</span>
                                                                        <?php echo $comments['comments'][$i]->getContent(); ?>
                                                                    </div>
                                                                </span>
                                                                <div class="_10lo"></div>
                                                            </div>
                                                            <span></span>
                                                            <div></div>
                                                        </div>
                                                        <div class="fsm fwn fcg UFICommentActions">
                                                            <a class="like-button" onclick="doCommentReaction(this, 'like');">Like</a>
                                                            <span class="reaction-total like-reaction-total"><?=$comments['comments'][$i]->like?></span>
                                                            <span> · </span>
                                                            <a class="dislike-button" onclick="doCommentReaction(this, 'dislike');">Dislike</a>
                                                            <span class="reaction-total dislike-reaction-total"><?=$comments['comments'][$i]->dislike?></span>
                                                            <span> · </span>
                                                            <span>
                                                                <a class="uiLinkSubtle">28m</a>
                                                             </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            if (isset($comments['total']) && intval($comments['total']) > LIMIT_COMMENT_PER_CONFESSION) {
                                ?>
                                <div id="load-more-comments" onclick="loadMoreComment()"
                                     style="padding: 12px; text-align: center;"><a>Xem thêm</a></div>
                                <?php
                            }
                            ?>

                            <div class="write-comment">
                                <div class="write-comment-block">
                                    <div class="write-comment-input">
                                        <div aria-expanded="false"
                                             style="outline: none; user-select: text; white-space: pre-wrap; word-wrap: break-word;"
                                             contenteditable="true" data-contents="true" data-text="true"
                                             id="comment-content">Viết bình luận ...
                                        </div>
                                    </div>
                                    <div class="send-comment2">
                                        <a class="send-comment" title="Shift + Enter"
                                           href="javascript:comment();">Gửi</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <script type="text/javascript" language="javascript" src="/confession/public/main.js"></script>
                <?php
            } else echo "<h2 style='text-align: center;'>Đã có lỗi xảy ra</h2>";
            ?>
        </div>
    </div> <!-- /container -->
</div>
</body>
</html>
