<?php
require 'controllers/EventController.php';
require 'views/layout/header.php';
require 'controllers/BannerController.php';
$bannerC = new BannerController();
$banner = $bannerC->getActive();

$eventC = new EventController();
// ambil keyword search (dari banner)
$q = $_GET['q'] ?? '';
$category = $_GET['category'] ?? null;

// PRIORITAS:
// 1. search
// 2. category
// 3. semua event
if (!empty($q)) {
    $data = $eventC->search($q);
} elseif (!empty($category)) {
    $data = $eventC->getByCategory($category);
} else {
    $data = $eventC->index();
}
?>
<!-- HERO / BANNER -->
<div class="max-w-7xl mx-auto mb-12 px-4">
  <div class="relative h-[340px] rounded-2xl overflow-hidden shadow-2xl border border-neutral-800 bg-neutral-900">

    <!-- IMAGE -->
    <img 
      src="<?= $banner['image'] ?? 'Public/Images/BGPROJEKWEB.png' ?>" 
      class="absolute inset-0 w-full h-full object-cover"
      alt="Banner Event"
    >

    <!-- OVERLAY (lebih soft, tidak nyatu) -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>

    <!-- CONTENT -->
    <div class="relative z-10 h-full flex flex-col justify-center px-10 max-w-2xl">
      <h1 class="text-4xl font-bold mb-3 text-white">
        Temukan Event Favoritmu
      </h1>

      <p class="text-gray-300 mb-6">
        Konser, festival, olahraga, seni, dan event terbaik lainnya
      </p>

      <!-- SEARCH -->
        <form action="index.php" method="get" class="flex max-w-xl gap-2">
    <input type="hidden" name="page" value="search">

    <input type="search" name="q"
      class="w-full px-4 py-3 rounded-lg bg-neutral-800 border border-neutral-700 text-white
            focus:outline-none focus:ring-2 focus:ring-red-600"
      placeholder="Cari acara, artis, atau lokasi..."
      required>

    <button class="bg-red-600 hover:bg-red-700 px-6 rounded-lg font-semibold">
      Cari
    </button>
  </form>
      </div>

    </div>
  </div>


<!-- KATEGORI -->
<div class="flex gap-6 mb-8 text-sm font-medium text-gray-300">
  <a href="index.php?page=home" class="text-red-500">Semua</a>
  <a href="index.php?page=home&category=musik">Musik</a>
  <a href="index.php?page=home&category=olahraga">Olahraga</a>
  <a href="index.php?page=home&category=festival">Festival</a>
  <a href="index.php?page=home&category=seni">Seni</a>
</div>

<!-- EVENT LIST -->
<h2 class="text-xl font-semibold mb-6">Rekomendasi untuk Anda</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<?php foreach($data as $e): ?>
  <div class="bg-neutral-900 rounded-xl overflow-hidden shadow hover:scale-[1.02] transition ">

    <!-- IMAGE -->
 <img  src="Public/Images/Events/<?= !empty($e['image']) ? htmlspecialchars($e['image']) : 'default.jpg' ?>"
      class="h-44 w-full object-cover"

    <!-- CONTENT -->
    <div class="p-4">
      <h3 class="font-semibold text-lg mb-1 line-clamp-2">
        <?= htmlspecialchars($e['title']) ?>
      </h3>

      <p class="text-sm text-gray-400 mb-2">
        <?= htmlspecialchars($e['location']) ?>
      </p>

      <p class="font-bold text-red-500 mb-4">
        Rp <?= number_format($e['price'], 0, ',', '.') ?>
      </p>

      <div class="flex gap-2">
        <a href="index.php?page=detail&id=<?= $e['id'] ?>"
          class="flex-1 text-center bg-red-600 hover:bg-red-700 py-2 rounded-lg text-sm font-semibold">
          Detail & Pesan
        </a>

      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>

<?php require 'views/layout/footer.php'; ?>
