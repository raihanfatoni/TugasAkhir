<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    
    <title>Dashboard</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm" id="Navbar">
      <div class="container">
        <div class="logo">
          <img src="../image/logo.png" alt="">
          <a class="navbar-brand" href="#">SIG</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about">About</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Service
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="viewstore">Product Store</a></li>
                <li><a class="dropdown-item" href="viewpetsitting">Pet Sitting</a></li>
                <li><a class="dropdown-item" href="viewvetservice">Vet Service</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="viewcontact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn" href="login">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Header -->
    <Header class="jumbotron-fluid" id="Header">
      <div class="container">
        <div class="row">
          <div class="col-6 contain">
            <h4>Sistem Informasi Geografis Berbasis Web untuk Digitalisasi Peninggalan Tanah Wakaf Pangeran Sumedang</h4>
            <P>Kerajaan ini didirikan pada tahun 721 M oleh Prabu Tajimalela, keturunan dari raja Wretikandayun dari Kerajaan Galuh, di wilayah bekas dari Kerajaan Tembong Agung. Kerajaan ini juga pernah dikenal dengan nama Kerajaan Himbar Buana sebelum berganti nama menjadi Sumedang Larang.Sumedang Larang berstatus sebagai bagian dari Kerajaan Sunda dan Galuh antara abad ke-8 sampai abad ke-16 M, dimana penguasanya berada di bawah penguasa kedua kerajaan tersebut.Ibu kota Sumedang Larang di saat pendiriannya berada di Citembong Girang, yang saat ini masuk dalam wilayah desa Cikeusi, Kec. Darmaraja, Kab. Sumedang.</P>
            <button class="btn">Cari Data Tanah Wakaf</button>
          </div>
          <div class="col-5 offset-1">
            <img src="../image/LogoKSLkecil.png" alt="">
          </div>
        </div>
      </div>
    </Header>
    <!-- End Header -->

    <!-- About -->
    <section class="container" id="About">
      <div class="row">
        <div class="col">
          <img src="../image/logoyps1.png" >
        </div>
        <div class="col">
          <div class="Header">
            <h2>Yayasan Pangeran Sumedang </h2>
            <span class="divider-one"></span>
            <span class="divider-two"></span>
            <span class="divider-three"></span>
          </div>
          <p class="body">Sistem informasi yang dibuat dilengkapi dengan fitur - fitur ditujukan untuk membantu para pengelola tanah wakaf Yayasan Pangeran Sumedang. Informasi yang disediakan berupa persebaran tanah wakaf pada 3 kecamatan yaitu Sumedang Utara, Sumedang Selatan dan Conggeang</p>
          <!-- <span class="square">Sebaran Tanah Wakaf</span> -->
          <div class="Card shadow-sm">
            <div class="contain one">
              <h3>8</h3>
              <p>Sumedang Utara</p>
            </div>
            <div class="contain two">
              <h3>21</h3>
              <p>Sumedang Selatan</p>
            </div>
            <div class="contain three">
              <h3>2</h3>
              <p>Conggeang</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End About -->

    <!-- Service -->
    <section class="container" id="Service">
      <div class="Header">
        <h2>Lorem Ipsum</h2>
      </div>
      <div class="row">
        <div class="col">
          <div class="Card shadow-sm">
            <h3 class="text-center">Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In placerat euismod eros at sagittis. Mauris tincidunt dolor sed urna euismod pharetra.</p>
            <button class="btn container-fluid">Explore Now</button>
          </div>
        </div>
        <div class="col">
          <div class="Card shadow-sm">
            <h3 class="text-center">Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In placerat euismod eros at sagittis. Mauris tincidunt dolor sed urna euismod pharetra.</p>
            <button class="btn container-fluid">Explore Now</button>
          </div>
        </div>
        <div class="col">
          <div class="Card shadow-sm">
            <h3 class="text-center">Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In placerat euismod eros at sagittis. Mauris tincidunt dolor sed urna euismod pharetra.</p>
            <button class="btn container-fluid">Explore Now</button>
          </div>
        </div>
      </div>     
    </section>
    <!-- End Service -->

    <!-- Feedback -->
    <section class="container" id="Feedback">
      <div class="Feedback Header">
        <h2>Customer Feedback</h2>
      </div>
      <div class="row">
        <div class="col">
          <div class="Card shadow-sm">
            <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit. In placerat euismod eros at sagittis. Mauris tincidunt dolor sed urna euismod pharetra.”</p>
            <div class="biodata">
              <img src="../image/Feedback1.png" alt="">
              <div class="contain">
                <h4>John Doe</h4>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
         <div class="Card shadow-sm">
          <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit. In placerat euismod eros at sagittis. Mauris tincidunt dolor sed urna euismod pharetra.”</p>
          <div class="biodata">
            <img src="../image/Feedback2.png" alt="" class="avatar">
            <div class="contain">
              <h4>Arthur Dennis</h4>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star"></i>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
    <!-- End Feedback -->
    
          		  <!-- Footer -->
                <footer class="jumbotron-fluid" id="Footer">
      <div class="container">
        <div class="row">
          <div class="col-5">
            <div class="about">
              <div class="logo">
                <img src="../image/logo.png" alt="">
                <a class="navbar-brand" href="#">SIG</a>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In placerat euismod eros at sagittis. Mauris tincidunt dolor sed urna euismod pharetra.</p>
            </div>
          </div>
          <div class="col-2 offset-1">
            <div class="company">
              <h4>Lorem</h4>
              <ul>
                <li>
                  <a href="">Home</a>
                </li>
                <li>
                  <a href="">About Us</a>
                </li>
                <li>
                  <a href="">Contact Us</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-2">
            <div class="services">
              <h4>Lorem</h4>
              <ul>
                <li>
                  <a href="">Lorem Ipsum</a>
                </li>
                <li>
                  <a href="">Lorem Ipsum</a>
                </li>
                <li>
                  <a href="">Lorem Ipsum</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-2">
            <div class="information">
              <h4>Lorem</h4>
              <ul>
                <li>
                  <a href="">Terms & Conditions</a>
                </li>
                <li>
                  <a href="">Privacy Police</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>