<?php
require 'controllers/AdminMiddleware.php';
require 'config/database.php';
require 'views/layout/header.php';

$db = (new Database())->connect();
$event_id = $_GET['event_id'];

if($_SERVER['REQUEST_METHOD']==='POST'){
    $stmt = $db->prepare(
        "INSERT INTO ticket_types (event_id, name, price, stock, notes)
         VALUES (?,?,?,?,?)"
    );
    $stmt->execute([
        $event_id,
        $_POST['name'],
        $_POST['price'],
        $_POST['stock'],
        $_POST['notes']
    ]);
    header("Location: index.php?page=admin_ticket_type&event_id=$event_id");
}
?>

<h2 class="text-xl font-bold mb-4">Tambah Jenis Tiket</h2>

<form method="post" class="space-y-4 bg-white p-6 rounded shadow max-w-md">
  <input name="name" placeholder="Reguler / VIP" class="border p-2 w-full">
  <input name="price" type="number" placeholder="Harga" class="border p-2 w-full">
  <input name="stock" type="number" placeholder="Stok" class="border p-2 w-full">
  <textarea name="notes" placeholder="Keterangan" class="border p-2 w-full"></textarea>
  <button class="bg-red-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php require 'views/layout/footer.php'; ?>