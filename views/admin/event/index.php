<?php
require 'controllers/AdminMiddleware.php';
require 'controllers/EventController.php';
require 'views/layout/header.php';


$event = new EventController();
$data = $event->index();
?>

<div class="max-w-6xl mx-auto">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Admin - Data Event</h1>

    <a href="index.php?page=admin_event_create"
       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
       + Tambah Event
    </a>
  </div>
  

  <div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-100">
        <tr>
          <th class="p-4 text-left">Judul</th>
          <th class="p-4 text-left">Lokasi</th>
          <th class="p-4 text-left">Harga</th>
          <th class="p-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($data as $e): ?>
      <tr class="border-b">

        <td class="py-3 text-gray-800 font-medium">
          <?= htmlspecialchars($e['title']) ?>
        </td>

        <td class="py-3 text-gray-600">
          <?= htmlspecialchars($e['location']) ?>
        </td>

        <td class="py-3 text-red-600 font-semibold">
          Rp <?= number_format($e['price'], 0, ',', '.') ?>
        </td>

        <td class="py-3 text-center">
          <a href="index.php?page=admin_event_edit&id=<?= $e['id'] ?>"
            class="bg-blue-600 text-white px-3 py-1 rounded">
            Edit
          </a>

          <a href="index.php?page=admin_event_delete&id=<?= $e['id'] ?>"
            class="bg-red-600 text-white px-3 py-1 rounded ml-2">
            Hapus
          </a>
        </td>

      </tr>
      <?php endforeach; ?>

      <?php if(empty($data)): ?>
      <tr>
        <td colspan="4" class="p-6 text-center text-gray-500">
          Belum ada data event
        </td>
      </tr>
      <?php endif; ?>
      </tbody>

        <?php if(empty($data)): ?>
        <tr>
          <td colspan="4" class="p-6 text-center text-gray-500">
            Belum ada data event
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require 'views/layout/footer.php'; ?>