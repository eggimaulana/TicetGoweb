<footer class="bg-[#0b1220] text-gray-300 mt-24">
  <div class="max-w-7xl mx-auto px-6 py-16">

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-12">

      <!-- APP DOWNLOAD -->
      <div>
        <h3 class="text-white font-semibold mb-4 tracking-wide">
          Do more with <span class="text-red-500">TiketGo</span>
        </h3>

        <p class="text-sm text-gray-400 leading-relaxed">
          Platform tiket event konser, festival, olahraga, dan hiburan terbaik di Indonesia.
        </p>
      </div>

      <!-- EVENT CATEGORY -->
      <div>
        <h3 class="text-white font-semibold mb-4 tracking-wide">
          Event Populer
        </h3>
        <ul class="space-y-2 text-sm">
          <li><a href="index.php?page=home&category=konser" class="footer-link">Konser Musik</a></li>
          <li><a href="index.php?page=home&category=festival" class="footer-link">Festival</a></li>
          <li><a href="index.php?page=home&category=olahraga" class="footer-link">Olahraga</a></li>
          <li><a href="index.php?page=home&category=seni" class="footer-link">Seni & Budaya</a></li>
        </ul>
      </div>

      <!-- HELP -->
      <div>
        <h3 class="text-white font-semibold mb-4 tracking-wide">
          Bantuan
        </h3>
        <ul class="space-y-2 text-sm">
          <li><a href="index.php?page=help" class="footer-link">Pusat Bantuan</a></li>
          <li><a href="https://wa.me/6282110731106?text=bapaapakahudahngopi?" target="_blank" class="footer-link">Hubungi via WhatsApp</a></li>
        </ul>
      </div>

      <!-- ABOUT -->
      <div>
        <h3 class="text-white font-semibold mb-4 tracking-wide">
          Tentang TiketGo
        </h3>
        <ul class="space-y-2 text-sm">
          <li><a href="index.php?page=about" class="footer-link">Tentang Kami</a></li>
          <li><a href="index.php?page=privacy" class="footer-link">Kebijakan Privasi</a></li>
        </ul>
      </div>

    </div>

    <!-- BOTTOM -->
    <div class="border-t border-neutral-800 mt-14 pt-8
                flex flex-col md:flex-row justify-between items-center gap-6">

      <p class="text-sm text-gray-500">
        © <?= date('Y') ?> <span class="text-white">TiketGo</span>. All rights reserved.
      </p>

      <!-- SOCIAL MEDIA -->
        <div class="flex gap-4 justify-center mt-6">

      <a href="https://instagram.com/tiketgo" target="_blank"
        class="social-icon instagram"
        data-tooltip="Instagram">
        <i class="fa-brands fa-instagram"></i>
      </a>

      <a href="https://wa.me/6282110731106?text=bapaapakahudahngopi?" target="_blank"
        class="social-icon whatsapp"
        data-tooltip="WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
      </a>

      <a href="https://youtube.com/@tiketgo" target="_blank"
        class="social-icon youtube"
        data-tooltip="YouTube">
        <i class="fa-brands fa-youtube"></i>
      </a>

    </div>
    </div>

  </div>
</footer>
