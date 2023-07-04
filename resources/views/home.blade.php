<!DOCTYPE html>
<html>
<head>
  <title>Welcome Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to bottom, #0080FF, #00BFFF);
      background-image: url("{{asset('img/1.jpg')}}");
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
    }

    header {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      text-align: center;
    }

    nav {
      background-color: rgba(255, 255, 255, 0.5);
      padding: 10px;
      text-align: center;
    }

    nav ul {
      list-style: none;
      display: inline-block;
    }

    nav ul li {
      display: inline-block;
      margin-right: 10px;
    }

    nav ul li a {
      color: #333;
      text-decoration: none;
      padding: 5px 10px;
    }

    section {
      margin: 20px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.5);
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
    }

    footer {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <header>
    <h1>Welcome to Our Website</h1>
  </header>

  <nav>
    <ul>
      <li><a href="#home">Beranda</a></li>
      <li><a href="#about">Tentang</a></li>
      <li><a href="#contact">Kontak</a></li>
      <li><a href="{{route('signin')}}" class="nav-link text-white d-none">
        Masuk
    </a></li>
      <li><a href="{{route('register')}}" class="nav-link text-white d-none">
        Daftar
    </a></li>
    </ul>
  </nav>

  <section id="home">
    <h2>Selamat Datang</h2>
    <p>This section showcases the home content of our website.</p>
  </section>

  <section id="about">
    <h2>Tentang Kami</h2>
    <p>This section provides information about our company or organization.</p>
  </section>


  <section id="contact">
    <h2>Hubungi Kami</h2>
    <p>This section contains contact information and a contact form.</p>
  </section>


  <footer>
    <p>&copy; 2023 SPK-AHP. All rights reserved.</p>
  </footer>
</body>
</html>
