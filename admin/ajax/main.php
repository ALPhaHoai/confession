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

    switch (strtolower($_GET['type'])) {
        case "all post":
            {
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    if(is_numeric($page) && intval($page) >= 0){
                        echo json_encode($admin->getAllPost($page));
                        return ;
                    }
                }
                break;
            }
    }

} else {
   return ;
}
