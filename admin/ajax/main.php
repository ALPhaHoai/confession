<?php
/**
 * Created by Long
 * Date: 11/29/2018
 * Time: 2:41 PM
 */
if (!isset($_GET['type'])) return;

session_start();

if (isset($_SESSION['login']['success']) && $_SESSION['login']['success']) {
    require_once __DIR__ . "/../class/admin.php";
    $id = $_SESSION['login']['id'];

    $admin = new admin($id);

    header('Content-Type: application/json');

    $page = (isset($_GET['page']) && is_numeric($_GET['page']) && intval($_GET['page']) >= 0) ? intval($_GET['page']) : 0;

    switch (strtolower($_GET['type'])) {
        case "all post":
            {
                echo json_encode($admin->getAllPost($page));
                return;
            }
        case "not verified":
            {
                echo json_encode($admin->getRecentlyPostNotYetApproval($page));
                return;
            }
    }

} else {
    return;
}
