<?php
require 'controllers/WishlistController.php';
require 'views/layout/header.php';

if(!isset($_SESSION['user'])){
    header("Location: index.php?page=login");
    exit;
}

$wc = new WishlistController();
$events = $wc->getByUser($_SESSION['user']['id']);
?>

<h1 class="text-2xl font-bold mb-6 text-white">Wishlist Saya</h1>

<?php if(empty($events)): ?>
  <p class="text-gray-400">Wishlist masih kosong</p>
<?php else: ?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<?php foreach ($events as $e): ?>
  <div class="bg-[#1c1c1c] rounded-lg p-5 text-white shadow hover:shadow-lg transition">

    <h3 class="font-semibold text-lg mb-1">
      <?= htmlspecialchars($e['title']) ?>
    </h3>

    <p class="text-gray-400 text-sm mb-2">
      📍 <?= htmlspecialchars($e['location']) ?>
    </p>

    <p class="font-bold text-red-500 mb-4">
      Rp <?= number_format($e['price'], 0, ',', '.') ?>
    </p>

    <a href="index.php?page=detail&id=<?= $e['id'] ?>"
       class="inline-block bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-sm font-semibold">
       Lihat Detail
    </a>

  </div>
<?php endforeach; ?>
</div>

<?php endif; ?>

<?php require 'views/layout/footer.php'; ?>