<?php
require 'controllers/AuthController.php';
require 'views/layout/header.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $auth = new AuthController();
    $auth->register($_POST['name'], $_POST['email'], $_POST['password']);
    header("Location: index.php?page=login");
    exit;
}
?>

<!-- BACKGROUND NETFLIX STYLE -->
<div class="min-h-screen relative flex items-center justify-center px-4">

  <!-- BACKGROUND IMAGE -->
  <div class="absolute inset-0 animate-bg">
    <img src="public/images/BGKKK.png"
         class="w-full h-full object-cover"
         alt="Background Register">
    <div class="absolute inset-0 bg-black/65"></div>
  </div>

  <!-- REGISTER CARD -->
  <div class="relative z-10 w-full max-w-md
              bg-black/80 rounded-md p-8 shadow-2xl
              animate-fade-in">

    <!-- TITLE -->
    <h2 class="text-3xl font-bold text-white mb-6">
      Daftar
    </h2>

    <form method="post" class="space-y-4">

      <!-- NAMA -->
      <input type="text" name="name" required
        placeholder="Nama lengkap"
        class="w-full px-4 py-3 rounded
               bg-neutral-800 text-white placeholder-gray-400
               border border-neutral-700
               focus:outline-none focus:ring-2 focus:ring-red-600
               transition duration-200">

      <!-- EMAIL -->
      <input type="email" name="email" required
        placeholder="Email"
        class="w-full px-4 py-3 rounded
               bg-neutral-800 text-white placeholder-gray-400
               border border-neutral-700
               focus:outline-none focus:ring-2 focus:ring-red-600
               transition duration-200">

      <!-- PASSWORD -->
      <div class="relative">
        <input
          type="password"
          name="password"
          id="registerPassword"
          required
          placeholder="Password"
          class="w-full px-4 py-3 pr-12 rounded
                bg-neutral-800 text-white placeholder-gray-400
                border border-neutral-700
                focus:outline-none focus:ring-2 focus:ring-red-600
                transition duration-200">

        <!-- EYE ICON -->
        <button type="button"
          onclick="togglePassword('registerPassword', this)"
          class="absolute right-3 top-1/2 -translate-y-1/2
                text-gray-400 hover:text-white transition">
          🙉
        </button>
      </div>

      <!-- BUTTON -->
      <button
        class="w-full bg-red-600 hover:bg-red-700
               text-white py-3 rounded
               font-semibold text-lg
               transition duration-200">
        Daftar
      </button>

    </form>

    <!-- LOGIN LINK -->
    <div class="mt-6 text-sm text-gray-400">
      Sudah punya akun?
      <a href="index.php?page=login"
         class="text-red-500 hover:underline font-semibold">
        Login
      </a>
    </div>

  </div>
</div>

<?php require 'views/layout/footer.php'; ?>