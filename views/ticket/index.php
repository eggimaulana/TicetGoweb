<?php
require 'controllers/TicketController.php';
require 'views/layout/header.php';

if(!isset($_SESSION['user'])){
    header("Location: index.php?page=login");
    exit;
}

$ticketC = new TicketController();
$tickets = $ticketC->getByUser($_SESSION['user']['id']);
?>

<h1 class="text-2xl font-bold mb-6">Tiket Saya</h1>

<?php if(empty($tickets)): ?>
  <p class="text-gray-500">Belum ada tiket</p>
<?php else: ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<?php foreach($tickets as $t): ?>
  <div class="bg-[#1c1c1c] shadow-lg rounded-lg p-5 border-l-4 border-red-600 text-white">

    <h3 class="font-semibold text-lg mb-1 text-white">
      <?= htmlspecialchars($t['title']) ?>
    </h3>

    <p class="text-gray-400 text-sm mb-2">
      📍 <?= htmlspecialchars($t['location']) ?>
    </p>

    <div class="mt-4 text-sm">
      <span class="font-semibold text-gray-300">Kode Tiket:</span><br>
      <span class="font-mono text-lg tracking-wider text-red-500">
        <?= $t['ticket_code'] ?>
      </span>
    </div>

  </div>
<?php endforeach; ?>
</div>

<?php endif; ?>

<?php require 'views/layout/footer.php'; ?>