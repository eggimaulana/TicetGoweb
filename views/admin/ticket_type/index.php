<?php
require 'controllers/AdminMiddleware.php';
require 'config/database.php';
require 'views/layout/header.php';

$db = (new Database())->connect();
$event_id = $_GET['event_id'];

$stmt = $db->prepare("SELECT * FROM ticket_types WHERE event_id=?");
$stmt->execute([$event_id]);
$types = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="text-3xl font-bold mb-6 text-black">
  Jenis Tiket
</h1>

<a href="index.php?page=admin_ticket_type_create&event_id=<?= $event_id ?>"
   class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg mb-6 inline-block font-semibold">
   + Tambah Jenis Tiket
</a>

<table class="w-full bg-white shadow-lg rounded-lg opacity-100">
  <thead class="bg-gray-100">
    <tr>
      <th class="p-4 text-left font-bold text-gray-900">Nama</th>
      <th class="p-4 text-left font-bold text-gray-900">Harga</th>
      <th class="p-4 text-left font-bold text-gray-900">Stok</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($types as $t): ?>
      <tr class="border-t hover:bg-gray-50 transition">
        <td class="p-4 text-black font-semibold">
          <?= htmlspecialchars($t['name']) ?>
        </td>

        <td class="p-4 text-black">
          Rp <?= number_format($t['price']) ?>
        </td>

        <td class="p-4 text-black font-semibold">
          <?= $t['stock'] ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<?php require 'views/layout/footer.php'; ?>