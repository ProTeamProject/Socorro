<div id="myNav" class="overlay">
  <div class="overlay-content">
    <section class="search__results h-padding-xlarge animated" id="searchresults">
      <h1 class="search__title animated fadeInUp">Search Results for <strong><span class="notranslate" id="searchterm"></span></strong></h1>

      <div class="problems animated fadeIn">
        <div class="problem__titles h-padding-small ">
          <p>
            Problem ID
          </p>
          <p>
            Caller Name
          </p>
          <p>
            Date Submitted
          </p>
          <p>
            Last Updated
          </p>
          <p>
            Problem Type
          </p>
          <p>
            State
          </p>
        </div>
        <div class="problems__inner">
        </div>
      </div>
      <div class="button__container v-padding-mid">
        <button class="button__load">Load More</button>
      </div>
    </section>
  </div>

</div>
<header class="header">
  <div class="header__inner h-padding-xlarge">
    <a href="../operator/index.html" class="logo">
      <img class="logo__img" src="../img/logo.png" />
    </a>
    <div class="btn__new">
      <button class="toggle-button" onclick="closeNav();">☰</button>
      <div class="menu__desktop">
        <div class="dropdown">
        <a href="../new"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
        <div class="dropdown-content">
          <a href="">New Problem</a>
          </div>
        </div>
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
      <input autocomplete="off" id="search" oninput="showSearch()" type="text" name="search" placeholder="&#xf002; Search...">
      <div onclick="clearSearch()" class="cancel__search" id="cancelsearch">
        <i class="fa fa-times" aria-hidden="true"></i>
      </div>
    </div>
  </nav>
</header>
<nav id="menu" class="menu slideout-menu slideout-menu-right">
    <section class="menu-section">
      <ul class="menu-section-list">
        <li><a href="../new"><i class="fa fa-plus-square" aria-hidden="true"></i> New Problem</a></li>
        <li><a><i class="fa fa-language" aria-hidden="true"></i> Change Language</a></li>
        <li><a href="../analytics" ><i class="fa fa-pie-chart" aria-hidden="true"></i> Analytics</a></li>
        <li><a href="../" >  <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>

      </ul>
    </section>
  </nav>
  <script>
  var slideout = new Slideout({
    'panel': document.getElementById('panel'),
    'menu': document.getElementById('menu'),
    'padding': 256,
    'tolerance': 70,
    'touch': false
  });
  // Toggle button
  document.querySelector('.toggle-button').addEventListener('click', function() {
    slideout.toggle();
  });

  </script>