<header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="./index.php" class="logo">
          <p class="hero-subtitle">Virtuart</p>
      </a>

      <div class="header-actions">

          <button class="search-btn">
              <ion-icon name="search-outline"></ion-icon>
          </button>

          <div class="lang-wrapper">
              <label for="language">
                  <ion-icon name="globe-outline"></ion-icon>
              </label>

              <select name="language" id="language">
                  <option value="en">EN</option>

                  <option value="ar">AR</option>
                  <option value="fr">FR</option>
              </select>
          </div>
        <?php
session_start();

if (isset($_SESSION["username"])) {
    echo '<a href="./assets/signout.php" class="btn btn-primary">Sign out</a>';
} else {
    echo '<a href="./assets/login.php" class="btn btn-primary">Sign in</a>';
}
?>


      </div>

      <button class="menu-open-btn" data-menu-open-btn>
        <ion-icon name="reorder-two"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

            <a href="./index.php" class="logo">
                <p class="hero-subtitle">virtuart</p>
            </a>

          <button class="menu-close-btn" data-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

          <li>
            <a href="./index.php" class="navbar-link">Home</a>
          </li>
          <?php
if(isset($_SESSION["username"])) {
    echo '
        <li>
            <a href="events.php" class="navbar-link">events</a>
        </li>
        <li>
            <a href="#" class="navbar-link">profile</a>
        </li>';

    // Check if the user is an artist
    if (isset($_SESSION["userType"]) && $_SESSION["userType"] == "artist") {
        echo '
            <li>
                <a href="add.php" class="navbar-link">Add event</a>
            </li>';
    }
}
?>

        </ul>

        <ul class="navbar-social-list">

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-pinterest"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

      </nav>

    </div>
  </header>