<?php
/**
 * Created by PhpStorm.
 * User: Long
 * Date: 9/30/2018
 * Time: 1:32 PM
 */
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/db.php";
require_once __DIR__ . "/function.php";
require_once __DIR__ . "/class/comment.php";
require_once __DIR__ . "/class/post.php";
require_once __DIR__ . "/class/user.php";

function isRequiredPost()
{
    return $_POST['edge'] !== "confession" || $_POST['action'] !== "create" ? true : false;
}

//check valid post params

if (isRequiredPost()) {
    if (!isset($_POST['post_id'])) {
        _return_error("missing post_id");
    }
}

if (!isset($_POST['edge'])) {
    _return_error("missing edge");
}
if (!isset($_POST['action'])) {
    _return_error("what is your action?");
}

$db = db::singleton();

if (isRequiredPost()) {
    //check valid confession id (has approved)
    $post = new post($_POST['post_id']);
    if (!$post->getProperties()) {
        _return_error("invalid post");
    }
    if (!$post->isApproved()) {
        _return_error("invalid post");
    }
}

$user_ip = user::getUserIp();
$user = new user($user_ip);
if (!is_numeric($user->id)) {
    _return_error("sorry. We have a problem!");
}


switch ($_POST['edge']) {
    case "confession":
        {
            switch ($_POST['action']) {
                case "like":
                    {
                        if ($post->doLike($user->id)) {
                            _return_success();
                        } else {
                            _return_error();
                        }
                        break;
                    }
                case "create":
                    {
                        if(!isset($_POST['content'])) {
                            _return_error("missing content");
                        }

                        $content = trim($_POST['content']);

                        if(strlen($content) < 10) {
                            _return_error("content too short");
                        }

                        if (post::create($content, $user->id)) {
                            _return_success();
                        } else {
                            _return_error();
                        }
                        break;
                    }
                case "dislike":
                    {
                        if ($post->doDislike($user->id)) {
                            _return_success();
                        } else {
                            _return_error();
                        }
                        break;
                    }
                case "comment":
                    {
                        if (isset($_POST['content'])) {
                            $content = urldecode($_POST['content']);
                            $comment_id = $post->doComment($content, $user->id);
                            if (is_numeric($comment_id)) {
                                _return_success(["comment_id" => $post->id . "_" . $comment_id]);
                            } else _return_error("insert comment error");
                        } else {
                            _return_error("mising comment content");
                        }
                        break;
                    }
                case "loadMoreComment":
                    {
                        if (isset($_POST['lastCommentId'])) {
                            $last_comment_id = comment::parseCommentId($_POST['lastCommentId']);
                            if ($last_comment_id === null) return;
                            $data = $post->getComments($last_comment_id);
                            if (is_array($data) && isset($data['comments'])) {
                                if (count($data['comments']) > 0) {
                                    $return_data['comments'] = array();
                                    foreach ($data['comments'] as $cmt) {
                                        $return_data['comments'][] = $cmt->getFakeInstance();
                                    }
                                    _return_success($return_data);
                                } else _return_success("no more");
                            } else {
                                _return_success("no more");
                            }
                            return;
                        } else _return_error("missing last comment");
                    }
                default:
                    {
                        _return_error("invalid action");
                    }
            }
        }
    case "comment":
        {
            if (isset($_POST['comment_id'])) {
                $comment_id = $_POST['comment_id'];
                if ($comment_id == null || !startsWith($comment_id, $post->id . "_")) return;
                $comment_id = explode("_", $comment_id)[1];
                if (!is_numeric($comment_id)) return;
                settype($comment_id, "int");
                $comment = new comment($comment_id);

            } else return;

            switch ($_POST['action']) {
                case "like":
                    {
                        if ($comment->doLike($user->id)) {
                            _return_success();
                        } else _return_error();
                        break;
                    }
                case "dislike":
                    {
                        if ($comment->doDislike($user->id)) {
                            _return_success();
                        } else _return_error();
                        break;
                    }
                default:
                    {
                        echo "Error";
                    }
            }
        }


    default:
        {
            echo "Error";
        }
}


function _return_error($message = null)
{
    _return(true, $message);
}

function _return_success($message = null)
{
    _return(false, $message);
}

function _return($value, $message = null)
{
    $a["error"] = $value;
    if ($message !== null) {
        $a["message"] = $message;
    }
    print_r(json_encode($a));
    exit();
}