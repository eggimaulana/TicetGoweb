<?php
require 'controllers/EventController.php';
require 'controllers/CartController.php';
require 'controllers/RatingController.php';
require 'views/layout/header.php';
require 'controllers/WishlistController.php';

$eventC  = new EventController();
$cart    = new CartController();
$ratingC = new RatingController();


// Validasi ID

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    echo "<p class='text-red-600'>Event tidak valid</p>";
    require 'views/layout/footer.php';
    exit;
}

$event = $eventC->detail($_GET['id']);

if(!$event){
    echo "<p class='text-red-600'>Event tidak ditemukan</p>";
    require 'views/layout/footer.php';
    exit;
}

$wishlistC = new WishlistController();
$isWishlisted = false;

if(isset($_SESSION['user'])){
    $isWishlisted = $wishlistC->isWishlisted(
        $_SESSION['user']['id'],
        $event['id']
    );
}




// Tambah ke keranjang
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticket_type'])){
    $ticketType = $_POST['ticket_type'];
  $cart->add((int)$event['id'], $ticketType);

    header("Location: index.php?page=cart");
    exit;
}

// Ambil rating
$reviews = $ratingC->getByEvent($event['id']);
?>

<div class="max-w-4xl mx-auto bg-[#111827] rounded-2xl shadow-2xl p-8 border border-neutral-800">

  <h1 class="text-4xl font-extrabold mb-4 text-white tracking-tight">
    <?= htmlspecialchars($event['title']) ?>
  </h1>

  <?php if(isset($_SESSION['user'])): ?>
    <div class="mb-4">
      <?php if($isWishlisted): ?>
        <a href="index.php?page=wishlist_remove&id=<?= $event['id'] ?>"
          class="inline-flex items-center text-red-600 font-semibold hover:underline">
          ♥ Hapus dari Wishlist
        </a>
      <?php else: ?>
        <a href="index.php?page=wishlist_add&id=<?= $event['id'] ?>"
          class="inline-flex items-center text-black font-semibold hover:text-red-600">
          ♡ Tambah ke Wishlist
        </a>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="text-gray-400 mb-2 flex items-center gap-2">
  📍 <?= htmlspecialchars($event['location']) ?>
</div>

  <p class="text-gray-400 mb-2 flex items-center gap-2">
    <?= nl2br(htmlspecialchars($event['desc'])) ?>
  </p>

  <!-- PILIH TIKET -->
  <form method="post">
    <label class="text-gray-400 mb-2 flex items-center gap-2">
      Pilih Jenis Tiket
    </label>

    <select name="ticket_type"
      class="border p-2 mb-4 w-full rounded bg-gray text-black opacity-100"
      required>
      <option value="reguler">
        Reguler — Rp <?= number_format($event['price']) ?>
      </option>
      <option value="vip">
        VIP — Rp <?= number_format($event['price'] * 2) ?>
      </option>
    </select>

    <button
      class="bg-red-600 hover:bg-red-700 text-gray px-6 py-3 rounded-lg text-lg opacity-100">
      Tambah ke Keranjang
    </button>
  </form>

  <!-- RATING -->
  <hr class="my-8">

  <h2 class="text-gray-400 mb-2 flex items-center gap-2">
    Rating & Ulasan
  </h2>

  <?php if(isset($_SESSION['user'])): ?>
    <form method="post" action="index.php?page=rate&id=<?= $event['id'] ?>">
      <label class="block mb-2 text-gray font-semibold">Rating</label>

      <select name="rating"
        class="border p-2 mb-3 rounded w-32 bg-gray text-gray"
        required>
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
      </select>

      <textarea name="review"
        class="border p-3 w-full rounded mb-4 text-black"
        placeholder="Tulis ulasan..."
        required></textarea>

      <button class="bg-gray-900 hover:bg-black text-gray px-4 py-2 rounded">
        Kirim Ulasan
      </button>
    </form>
  <?php else: ?>
    <p class="text-gray">
      <a href="index.php?page=login" class="text-red-600 font-semibold underline">
        Login
      </a> untuk memberi ulasan
    </p>
  <?php endif; ?>

  <!-- LIST REVIEW -->
  <div class="mt-6">
    <?php if(empty($reviews)): ?>
      <p class="text-gray-400 mb-2 flex items-center gap-2">Belum ada ulasan</p>
    <?php else: ?>
      <?php foreach($reviews as $r): ?>
        <div class="border rounded p-4 mb-3">
          <div class="font-semibold text-gray">
            <?= htmlspecialchars($r['name']) ?>
          </div>
          <div class="text-yellow-500 mb-1">
            <?= str_repeat('⭐', $r['rating']) ?>
          </div>
          <p class="text-gray">
            <?= nl2br(htmlspecialchars($r['review'])) ?>
          </p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</div>
<a id="btnBack"
   href="javascript:history.back()"
   class="fixed top-24 left-6 z-[9999]
          flex items-center gap-2
          bg-black/80 backdrop-blur
          px-4 py-2 rounded-full
          text-white shadow-lg
          transition-all duration-300
          hover:bg-black">
  ← <span class="hidden sm:inline text-sm">Kembali</span>
  <script>
  let lastScrollTop = 0;
  const btnBack = document.getElementById('btnBack');

  window.addEventListener('scroll', function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
      // Scroll ke bawah → sembunyikan
      btnBack.style.opacity = '0';
      btnBack.style.transform = 'translateX(-20px)';
      btnBack.style.pointerEvents = 'none';
    } else {
      // Scroll ke atas → tampilkan
      btnBack.style.opacity = '1';
      btnBack.style.transform = 'translateX(0)';
      btnBack.style.pointerEvents = 'auto';
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  });
</script>

</a>

<?php require 'views/layout/footer.php'; ?>