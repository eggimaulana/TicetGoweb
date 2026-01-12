<?php
require 'controllers/AdminMiddleware.php';
require 'controllers/EventController.php';

$eventC = new EventController();
$eventC->delete($_GET['id']);

header("Location: index.php?page=admin_event");