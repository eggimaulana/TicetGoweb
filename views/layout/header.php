<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* Social icon base */
.social-icon {
  position: relative;
  width: 42px;
  height: 42px;
  border-radius: 9999px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #1f2937;
  color: white;
  transition: all 0.3s ease;
}

/* Hover animation */
.social-icon:hover {
  transform: scale(1.12);
}

/* Tooltip */
.social-icon::after {
  content: attr(data-tooltip);
  position: absolute;
  bottom: -38px;
  left: 50%;
  transform: translateX(-50%);
  background: #000;
  color: #fff;
  font-size: 12px;
  padding: 4px 10px;
  border-radius: 6px;
  opacity: 0;
  pointer-events: none;
  white-space: nowrap;
  transition: opacity 0.3s ease;
}

.social-icon:hover::after {
  opacity: 1;
}

/* Brand colors */
.instagram:hover {
  background: linear-gradient(45deg,#f58529,#dd2a7b,#8134af);
  box-shadow: 0 0 18px rgba(221,42,123,.6);
}

.whatsapp:hover {
  background: #25D366;
  box-shadow: 0 0 18px rgba(37,211,102,.6);
}

.youtube:hover {
  background: #FF0000;
  box-shadow: 0 0 18px rgba(255,0,0,.6);
}
</style>


<head>
  <meta charset="UTF-8">
  <title>TiketGo</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<script>
function togglePassword(inputId, btn) {
  const input = document.getElementById(inputId);

  if (!input) return;

  if (input.type === "password") {
    input.type = "text";
    btn.textContent = "🙈";
  } else {
    input.type = "password";
    btn.textContent = "🙉";
  }
}
</script>

<body class="bg-gray-950 text-gray-100">

<!-- NAVBAR -->
<nav class="bg-gray-900 border-b border-gray-800">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

    <!-- LOGO -->
    <a href="index.php" class="text-2xl font-bold text-red-600">
      TiketGo
    </a>

    <!-- SEARCH -->
    <form action="index.php" method="get" class="hidden md:flex w-1/3">
      <input type="hidden" name="page" value="search">
      <input
        type="search"
        name="q"
        placeholder="Cari acara, artis, atau lokasi..."
        class="w-full px-4 py-2 rounded-l bg-gray-800 text-white placeholder-gray-400 focus:outline-none"
      >
      <button class="bg-red-600 px-4 rounded-r hover:bg-red-700">
        🔍
      </button>
    </form>

    <!-- MENU -->
    <div class="flex items-center gap-5 text-sm">

      <a href="index.php" class="hover:text-red-500">Beranda</a>
      <a href="index.php?page=cart" class="hover:text-red-500">Keranjang</a>
      <a href="index.php?page=ticket" class="hover:text-red-500">Tiket</a>

      <?php if(isset($_SESSION['user'])): ?>

        <a href="index.php?page=order" class="hover:text-red-500">Pesanan</a>

        <a href="index.php?page=wishlist" class="hover:text-red-500">
          Wishlist
        </a>

        <?php if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>
          <a href="index.php?page=admin_event"
             class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700">
            Admin
          </a>
        <?php endif; ?>

        <a href="index.php?page=logout"
           class="text-red-500 font-semibold hover:text-red-600">
           Logout
        </a>

      <?php else: ?>

        <a href="index.php?page=login"
           class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
           Login
        </a>

      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto px-6 py-8">
