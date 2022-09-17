<nav class="navbar navbar-expand-lg navbar-dark mb-3 bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URL_ROOT; ?>"><?php echo SITE_NAME; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL_ROOT; ?>/pages/about">About</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION["user_id"])): ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Welcom "<?php echo $_SESSION["user_name"]; ?>"</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>/users/logout">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>/users/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/login">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>