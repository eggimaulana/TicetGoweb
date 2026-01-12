<?php
require 'controllers/AdminMiddleware.php';
require 'controllers/EventController.php';
require 'views/layout/header.php';

$eventC = new EventController();
$id = $_GET['id'] ?? null;

if(!$id){
  header("Location: index.php?page=admin_event");
  exit;
}

$event = $eventC->find($id);

if(!$event){
  echo "<p class='text-red-500'>Event tidak ditemukan</p>";
  require 'views/layout/footer.php';
  exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (!empty($_FILES['image']['name'])) {

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid('event_') . '.' . $ext;

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            'Public/Images/Events/' . $imageName
        );

        $_POST['image'] = $imageName;
    }

    $eventC->update($id, $_POST);
    header("Location: index.php?page=admin_event");
    exit;
}
?>

<div class="max-w-3xl mx-auto mt-10">
  <div class="bg-neutral-900 rounded-xl shadow-lg p-8">

    <h2 class="text-2xl font-bold mb-6 text-white">
      Edit Event
    </h2>

    <form method="post" enctype="multipart/form-data" class="space-y-5">

      <!-- JUDUL -->
       <?php if (!empty($event['image'])): ?>
  <div>
    <p class="text-sm text-gray-400 mb-2">Foto Saat Ini</p>
    <img src="Public/Images/Events/<?= $event['image'] ?>"
         class="h-40 rounded-lg mb-3">
  </div>
<?php endif; ?>

      <div>
        <label class="block text-sm text-gray-300 mb-1">Judul Event</label>
        <input
          type="text"
          name="title"
          value="<?= htmlspecialchars($event['title']) ?>"
          required
          class="w-full px-4 py-3 rounded-lg bg-neutral-800 border border-neutral-700 text-white focus:ring-2 focus:ring-red-600 focus:outline-none"
        >
      </div>

      <!-- LOKASI -->
      <div>
        <label class="block text-sm text-gray-300 mb-1">Lokasi</label>
        <input
          type="text"
          name="location"
          value="<?= htmlspecialchars($event['location']) ?>"
          required
          class="w-full px-4 py-3 rounded-lg bg-neutral-800 border border-neutral-700 text-white focus:ring-2 focus:ring-red-600 focus:outline-none"
        >
      </div>

      <!-- HARGA -->
      <div>
        <label class="block text-sm text-gray-300 mb-1">Harga (Rp)</label>
        <input
          type="number"
          name="price"
          value="<?= (int)$event['price'] ?>"
          required
          class="w-full px-4 py-3 rounded-lg bg-neutral-800 border border-neutral-700 text-white focus:ring-2 focus:ring-red-600 focus:outline-none"
        >
      </div>

      <!-- DESKRIPSI -->
      <div>
        <label class="block text-sm text-gray-300 mb-1">Deskripsi</label>
        <textarea
          name="desc"
          rows="4"
          class="w-full px-4 py-3 rounded-lg bg-neutral-800 border border-neutral-700 text-white focus:ring-2 focus:ring-red-600 focus:outline-none"
        ><?= htmlspecialchars($event['desc']) ?></textarea>
      </div>
      
      <div>
  <label class="block text-sm text-gray-300 mb-1">Ganti Foto Event</label>
  <input type="file" name="image"
         accept="image/*"
         class="w-full text-white">
</div>


      <!-- BUTTON -->
      <div class="flex justify-between items-center pt-4">
        <a href="index.php?page=admin_event"
           class="text-gray-400 hover:text-white">
          ← Kembali
        </a>

        <button
          type="submit"
          class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg font-semibold text-white">
          Update Event
        </button>
      </div>

    </form>
  </div>
</div>

<?php require 'views/layout/footer.php'; ?>