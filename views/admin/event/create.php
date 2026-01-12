<?php
require 'controllers/AdminMiddleware.php';
require 'controllers/EventController.php';
require 'views/layout/header.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $imageName = null;

    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid('event_') . '.' . $ext;

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            'Public/Images/Events/' . $imageName
        );
    }

    $db = (new Database())->connect();
    $stmt = $db->prepare(
      "INSERT INTO events (title, location, price, `desc`, image)
      VALUES (?,?,?,?,?)"
    );
    $stmt->execute([
        $_POST['title'],
        $_POST['location'],
        $_POST['price'],
        $_POST['desc'],
        $imageName
    ]);

    header("Location: index.php?page=admin_event");
    exit;
}

?>

<div class="max-w-3xl mx-auto mt-10">
  <div class="bg-neutral-900 rounded-xl shadow-lg p-8">

    <h2 class="text-2xl font-bold mb-6 text-white">Tambah Event</h2>

    <form method="post" enctype="multipart/form-data" class="space-y-5">

      <div>
        <label class="block text-sm text-gray-400 mb-1">Judul Event</label>
        <input type="text" name="title"
               class="w-full px-4 py-3 rounded bg-neutral-800 border border-neutral-700 text-white"
               placeholder="Contoh: International Music Fest"
               required>
      </div>

      <div>
        <label class="block text-sm text-gray-400 mb-1">Lokasi</label>
        <input type="text" name="location"
               class="w-full px-4 py-3 rounded bg-neutral-800 border border-neutral-700 text-white"
               placeholder="Contoh: GBK Stadium"
               required>
      </div>

      <div>
        <label class="block text-sm text-gray-400 mb-1">Harga</label>
        <input type="number" name="price"
               class="w-full px-4 py-3 rounded bg-neutral-800 border border-neutral-700 text-white"
               placeholder="Contoh: 250000"
               required>
      </div>

      <div>
        <label class="block text-sm text-gray-400 mb-1">Deskripsi</label>
        <textarea name="desc" rows="4"
          class="w-full px-4 py-3 rounded bg-neutral-800 border border-neutral-700 text-white"
          placeholder="Deskripsi singkat event"></textarea>
      </div>

      <div>
  <label class="block text-sm text-gray-400 mb-1">Foto Event</label>
  <input type="file" name="image"
         accept="image/*"
         class="w-full px-4 py-2 bg-neutral-800 text-white rounded border border-neutral-700">
</div>

      <div class="flex justify-end gap-3">
        <a href="index.php?page=admin_event"
           class="px-5 py-2 rounded bg-gray-700 hover:bg-gray-600 text-white">
          Batal
        </a>

        <button
          class="px-6 py-2 rounded bg-red-600 hover:bg-red-700 text-white font-semibold">
          Simpan Event
        </button>
      </div>

    </form>
  </div>
</div>

<?php require 'views/layout/footer.php'; ?>