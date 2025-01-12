<header class="header sticky-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="../dashboard/dashboard.php" class="logo">
      <img src="../../assets/img/Logo.png" />
    </a>
    <button class="bi bi-list toggle-sidebar-btn bg-transparent border-0"></button>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <?php include __DIR__ . '/searcher.php' ?>
      <?php include __DIR__ . '/notifications.php' ?>
      <?php include __DIR__ . '/profile-links.php' ?>
    </ul>
  </nav>
</header>
