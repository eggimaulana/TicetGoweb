<?php
require 'controllers/OrderController.php';
require 'views/layout/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

$orderC = new OrderController();
$orders = $orderC->getByUser($_SESSION['user']['id']);
?>

<h1 class="text-2xl font-bold mb-6 text-white">Pesanan Saya</h1>

<?php if (empty($orders)): ?>
  <p class="text-gray-400">Belum ada pesanan</p>
<?php else: ?>

<div class="bg-[#1c1c1c] rounded-lg shadow-lg overflow-hidden">
<table class="w-full text-sm text-gray-200">
  <thead class="bg-[#2a2a2a] text-gray-300">
    <tr>
      <th class="p-4 text-left">ID</th>
      <th class="p-4 text-left">Tanggal</th>
      <th class="p-4 text-left">Total</th>
      <th class="p-4 text-left">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $o): ?>
    <tr class="border-t border-gray-700 hover:bg-[#242424] transition">
      <td class="p-4">#<?= $o['id'] ?></td>
      <td class="p-4"><?= $o['created_at'] ?></td>
      <td class="p-4 font-semibold text-red-500">
        Rp <?= number_format($o['total'], 0, ',', '.') ?>
      </td>
      <td class="p-4">
        <span class="bg-green-900/40 text-green-400 px-3 py-1 rounded-full text-sm font-semibold">
          <?= $o['status'] ?? 'paid' ?>
        </span>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>

<?php endif; ?>

<?php require 'views/layout/footer.php'; ?>
