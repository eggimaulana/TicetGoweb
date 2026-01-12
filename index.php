<?php
session_start();

$page = $_GET['page'] ?? 'home';

switch($page){

    case 'home':
        require 'views/event/index.php';
        break;

    case 'search':
        require 'views/event/search.php';
        break;

    case 'detail':
        require 'views/event/detail.php';
        break;

    case 'cart':
        require 'views/keranjang/index.php';
        break;

    case 'ticket':
        require 'views/ticket/index.php';
        break;

    case 'login':
        require 'views/auth/login.php';
        break;

    case 'register':
        require 'views/auth/register.php';
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php");
        break;

    case 'admin_event':
        require 'views/admin/event/index.php';
        break;

    case 'admin_event_create':
        require 'views/admin/event/create.php';
        break;

    case 'admin_event_edit':
        require 'views/admin/event/edit.php';
        break;

    case 'admin_event_delete':
        require 'views/admin/event/delete.php';
        break;
    
    case 'order':
        require 'views/order/index.php';
        break;

    case 'admin_ticket_type':
    require 'views/admin/ticket_type/index.php';
    break;

    case 'admin_ticket_type_create':
        require 'views/admin/ticket_type/create.php';
        break;

    case 'checkout':
    require 'views/checkout/index.php';
    break;

    case 'rate':
    require 'controllers/RatingController.php';

    if(!isset($_SESSION['user'])){
        header("Location: index.php?page=login");
        exit;
    }

    $ratingC = new RatingController();
    $ratingC->add(
        $_SESSION['user']['id'],
        $_GET['id'],
        $_POST['rating'],
        $_POST['review']
    );

    header("Location: index.php?page=detail&id=".$_GET['id']);
    break;

    case 'wishlist_add':
    if(!isset($_SESSION['user'])){
        header("Location: index.php?page=login");
        exit;
    }
    require 'controllers/WishlistController.php';
    $wc = new WishlistController();
    $wc->add($_SESSION['user']['id'], $_GET['id']);
    header("Location: index.php?page=detail&id=".$_GET['id']);
    exit;

    case 'wishlist_remove':
        if(!isset($_SESSION['user'])){
            header("Location: index.php?page=login");
            exit;
        }
        require 'controllers/WishlistController.php';
        $wc = new WishlistController();
        $wc->remove($_SESSION['user']['id'], $_GET['id']);
        header("Location: index.php?page=wishlist");
        exit;

    case 'wishlist':
        require 'views/wishlist/index.php';
        break;

    case 'cart_add':
    require 'controllers/CartController.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticket_type'])) {
    $cart->add((int)$event['id'], $_POST['ticket_type']);
    header("Location: index.php?page=cart");
    exit;
}
    header("Location: index.php?page=cart");
    exit;

    case 'checkout_process':
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=login");
        exit;
    }

case 'checkout_process':
    require 'controllers/OrderController.php';
    $orderC = new OrderController();
    $orderC->checkout($_SESSION['user']['id']);
    header("Location: index.php?page=order");
    exit;


    default:
        echo "404 - Halaman tidak ditemukan";
        break;
}