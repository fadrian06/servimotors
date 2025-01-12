<header class="header sticky-top d-flex align-items-center">
  <div class="d-flex align-items-center">
    <a href="../dashboard/dashboard.php">
      <img src="../../assets/img/Logo.png" height="30" />
    </a>
    <button class="bi bi-list toggle-sidebar-btn btn"></button>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <?php include __DIR__ . '/searcher.php' ?>
      <?php include __DIR__ . '/notifications.php' ?>
      <?php include __DIR__ . '/profile-links.php' ?>
    </ul>
  </nav>
</header>
