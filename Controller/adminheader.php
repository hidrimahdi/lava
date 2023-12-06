<header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="./index.php" class="logo">
          <p class="hero-subtitle">ElBay.Tn</p>
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
?>
    echo '<a href="./assets/login.php" class="btn btn-primary">Sign in</a>



      </div>

      <button class="menu-open-btn" data-menu-open-btn>
        <ion-icon name="reorder-two"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

            <a href="./index.php" class="logo">
                <p class="hero-subtitle">ElBay.Tn</p>
            </a>

          <button class="menu-close-btn" data-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

          <li>
            <a href="./dashboard.php" class="navbar-link">database</a>
          </li>
          <li>
            <a href="./category.php" class="navbar-link">categorys</a>
          </li>


        </ul>

      

      </nav>

    </div>
  </header>