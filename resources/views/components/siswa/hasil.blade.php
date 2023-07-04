@extends('layout.based-siswa')
@section('content')
	<!-- Main content -->
    <!DOCTYPE html>
<html>
<head>
  <title>Hasil Tes</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .result {
      margin-bottom: 20px;
      text-align: center;
    }

    .result h2 {
      color: #0080FF;
    }

    .score {
      margin-bottom: 20px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
    }

    .score span {
      color: #0080FF;
    }

    .feedback {
      margin-bottom: 20px;
      text-align: center;
    }

    .feedback p {
      color: #666;
    }

    .try-again-button {
      display: block;
      margin: 0 auto;
      padding: 10px 20px;
      background-color: #0080FF;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .try-again-button:hover {
      background-color: #0066CC;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Hasil Tes</h1>
    
    <div class="result">
      <h2>Selamat!</h2>
    </div>

    <div class="score">
      Skor Anda: <span>80</span>%
    </div>

    <div class="feedback">
      <p>Anda telah berhasil menyelesaikan tes dengan baik.</p>
    </div>

    <button type="button" class="try-again-button" onclick="tryAgain()">Coba Lagi</button>
  </div>

  <script>
    function tryAgain() {
      // Redirect ke halaman tes atau lakukan tindakan lainnya
      alert('Anda akan diarahkan ke halaman tes lagi.');
    }
  </script>
</body>
</html>


@endsection
