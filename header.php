<div id="myNav" class="overlay">
  <div class="overlay-content">
    <section class="search__results h-padding-xlarge animated" id="searchresults">
      <h1 class="search__title animated fadeInUp">Search Results for <strong><span class="notranslate" id="searchterm"></span></strong></h1>

      <div class="problems animated fadeIn" >

        <div class="problems__inner" id="search-results">
        </div>
      </div>

    </section>
  </div>

</div>
<div id="mobileMenu" class="mobile-menu">
  <a href="javascript:void(0)" class="menuClosebtn" onclick="closeMobileMenu()">&times;</a>
  <div class="mobile-menu-content">
    <?php

    if ($_SESSION['u_type'] == 'operator') {
            echo '<a href="../new"><i class="fa fa-plus-square" aria-hidden="true"></i> New Problem</a>';
          } else if ($_SESSION['u_type'] == 'specialist') {
            echo '<a href="#openModal"><i class="fa fa-hourglass" aria-hidden="true"></i>Mark as Busy</a>';
          }
     ?>
    
    <a href="../analytics"><i class="fa fa-pie-chart" aria-hidden="true"></i> Analytics</a>
    <a href="../includes/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
  </div>
</div>
<header class="header">
  <div class="header__inner h-padding-xlarge">
    <a href="../index.php" class="logo">
      <img class="logo__img" src="../img/logo.png" />
    </a>
    <div class="btn__new">
      <button class="toggle-button" onclick="openMobileMenu();">☰</button>
      <div class="menu__desktop">
        <?php

        if ($_SESSION['u_type'] == 'operator') {
                echo '<div class="dropdown">
                <a href="../new"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                <div class="dropdown-content">
                  <a href="">New Problem</a>
                  </div>
                </div>';
              } else if ($_SESSION['u_type'] == 'specialist') {
                echo '<div class="dropdown">
                <a href="#openModal"><i class="fa fa-hourglass" aria-hidden="true"></i></a>
                <div class="dropdown-content">
                  <a href="">Mark as Busy</a>
                  </div>
                </div>';
              }
         ?>
        <div class="dropdown">
          <div style=""></div>
        <a><i id="google_translate_element" class="fa fa-language" aria-hidden="true"></i></a>
        <div class="dropdown-content">
          <a href="">Change Language</a>
          </div>
        </div>
        <div class="dropdown">
        <a href="../analytics"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>
        <div class="dropdown-content">
          <a href="">Analytics</a>
          </div>
      </div>
      <div class="dropdown">
            <a href="../includes/logout.php"> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
      <div class="dropdown-content">
          <a href="/login" >Log Out</a>
          <a><i>Logged In as: <br /><?php echo $_SESSION['u_name'] . " | " . $_SESSION['u_type'] ?></i></a>
      </div>
      </div>
      </div>
  </div>
</div>
  <nav class="nav v-padding-xsmall h-padding-xlarge">
    <div class="search__area">
      <input autocomplete="off" id="search" oninput="showSearch()" type="text" name="search" placeholder="&#xf002; Search for ID, Caller Name or Problem Type...">
      <div onclick="clearSearch()" class="cancel__search" id="cancelsearch">
        <i class="fa fa-times" aria-hidden="true"></i>
      </div>
    </div>
  </nav>
</header>
<script>
function openMobileMenu() {
    document.getElementById("mobileMenu").style.width = "100%";
}

function closeMobileMenu() {
    document.getElementById("mobileMenu").style.width = "0%";
}

</script>
