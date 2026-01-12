<?php
require 'controllers/CartController.php';
require 'views/layout/header.php';

$cart = new CartController();
$items = $cart->get();
$total = 0;
?>

<div class="max-w-4xl mx-auto mt-10 text-white">

  <h1 class="text-2xl font-bold mb-6">Checkout</h1>

  <?php if(empty($items)): ?>
    <div class="text-center text-gray-400 mt-20">
      <p class="mb-4">Tidak ada item untuk dibayar</p>
      <a href="index.php"
         class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded">
         Kembali ke Event
      </a>
    </div>
  <?php else: ?>

  <!-- LIST ITEM -->
  <div class="bg-[#1c1c1c] rounded-lg overflow-hidden mb-6">
    <table class="w-full text-sm">
      <thead class="bg-[#2a2a2a] text-gray-300">
        <tr>
          <th class="p-4 text-left">Event</th>
          <th class="p-4 text-right">Harga</th>
          <th class="p-4 text-center">Qty</th>
          <th class="p-4 text-right">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($items as $item): 
          $subtotal = $item['price'] * $item['qty'];
          $total += $subtotal;
        ?>
        <tr class="border-t border-gray-700">
          <td class="p-4">
            <?= htmlspecialchars($item['title']) ?>
          </td>
          <td class="p-4 text-right">
            Rp <?= number_format($item['price'],0,',','.') ?>
          </td>
          <td class="p-4 text-center">
            <?= $item['qty'] ?>
          </td>
          <td class="p-4 text-right text-red-500 font-semibold">
            Rp <?= number_format($subtotal,0,',','.') ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- TOTAL -->
  <div class="flex justify-between items-center bg-[#1c1c1c] p-6 rounded-lg">
    <div>
      <p class="text-gray-400">Total Pembayaran</p>
      <p class="text-2xl font-bold text-white">
        Rp <?= number_format($total,0,',','.') ?>
      </p>
    </div>

    <a href="index.php?page=checkout_process"
      class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded">
      Bayar Sekarang
    </a>
  </div>

  <?php endif; ?>
</div>

<?php require 'views/layout/footer.php'; ?>