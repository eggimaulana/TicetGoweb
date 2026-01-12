<?php
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin'){
    die('Akses ditolak. Anda bukan admin.');
}