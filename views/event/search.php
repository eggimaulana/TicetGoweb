<?php
require 'controllers/EventController.php';
require 'views/layout/header.php';

$q = $_GET['q'] ?? '';
$eventC = new EventController();
$data = $eventC->search($q);
?>

<h1 class="text-2xl font-bold mb-6 text-white">
  Hasil pencarian: "<?= htmlspecialchars($q) ?>"
</h1>

<?php if(empty($data)): ?>
  <p class="text-gray-400">Tidak ada event ditemukan</p>
<?php else: ?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<?php foreach($data as $e): ?>
  <div class="bg-[#1c1c1c] rounded-xl shadow p-5 text-white border border-gray-800">

    <h3 class="text-lg font-semibold mb-1">
      <?= htmlspecialchars($e['title']) ?>
    </h3>

    <p class="text-sm text-gray-400 mb-2">
      📍 <?= htmlspecialchars($e['location']) ?>
    </p>

    <p class="text-red-500 font-bold mb-4">
      Rp <?= number_format($e['price'], 0, ',', '.') ?>
    </p>

    <a href="index.php?page=detail&id=<?= $e['id'] ?>"
      class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
      Detail
    </a>

  </div>
<?php endforeach; ?>
</div>

<?php endif; ?>

<?php require 'views/layout/footer.php'; ?>