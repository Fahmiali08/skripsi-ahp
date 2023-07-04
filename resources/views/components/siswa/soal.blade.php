@extends('layout.based-siswa')
@section('content')
	<!-- Main content -->
    <!DOCTYPE html>
<html>
<head>
  <title>Soal Matematika</title>
  <style>
    body {
      background-color: #f5f5f5;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    #countdown {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      color: #333;
      margin-bottom: 20px;
    }

    .question {
      margin-bottom: 20px;
    }

    h3 {
      margin-bottom: 10px;
      color: #333;
    }

    p {
      margin-bottom: 5px;
      color: #555;
    }

    .choices label {
      display: block;
      margin-bottom: 10px;
      cursor: pointer;
    }

    .submit-button {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      border: none;
      cursor: pointer;
    }

    .submit-button:hover {
      background-color: #0056b3;
    }

    .result {
      text-align: center;
      margin-top: 20px;
      color: #333;
    }

    .result .score {
      font-size: 24px;
      font-weight: bold;
    }

    .result .feedback {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Soal Matematika</h1>
    
    <div id="countdown">30:00</div> <!-- Tampilkan waktu hitung mundur -->
    
    <form id="quiz-form">
      <div class="question">
        <h3>Pertanyaan 1</h3>
        <p>Hitunglah hasil dari 3 + 5 x 2:</p>
        <div class="choices">
          <label><input type="radio" name="question1" value="9"> 9</label>
          <label><input type="radio" name="question1" value="13"> 13</label>
          <label><input type="radio" name="question1" value="15"> 15</label>
          <label><input type="radio" name="question1" value="11"> 11</label>
        </div>
      </div>

      <div class="question">
        <h3>Pertanyaan 2</h3>
        <p>Jika 2^x = 16, nilai dari x adalah:</p>
        <div class="choices">
          <label><input type="radio" name="question2" value="2"> 2</label>
          <label><input type="radio" name="question2" value="3"> 3</label>
          <label><input type="radio" name="question2" value="4"> 4</label>
          <label><input type="radio" name="question2" value="5"> 5</label>
        </div>
      </div>

      <!-- Tambahkan soal-soal lain sesuai kebutuhan -->

      <button type="button" class="submit-button" onclick="submitQuiz()">Submit</button>
    </form>

    <div id="result" class="result"></div>

    <script>
      var timeLeft = 1 * 60; // Konversi menit ke detik

      function countdown() {
        var countdownDiv = document.getElementById('countdown');
        var minutes = Math.floor(timeLeft / 60);
        var seconds = timeLeft % 60;

        // Tampilkan waktu hitung mundur dalam format MM:SS
        countdownDiv.textContent = (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

        if (timeLeft <= 0) {
            submitButton.disabled = true;
          // Jika waktu hitung mundur habis, hentikan penghitungan dan submit jawaban
          submitQuiz();
        } else {
          // Kurangi waktu hitung mundur setiap satu detik
          timeLeft--;
          setTimeout(countdown, 1000);
        }
      }

      countdown(); // Mulai penghitungan waktu hitung mundur

      function submitQuiz() {
        // Lakukan pengecekan jawaban dan tampilkan hasil
        var score = 0;
        var answers = document.querySelectorAll('input[type="radio"]:checked');

        for (var i = 0; i < answers.length; i++) {
          if (answers[i].value === "correct") {
            score++;
          }
        }

        var resultDiv = document.getElementById('result');
        resultDiv.innerHTML = '<p class="score">Skor Anda: ' + score + '/' + answers.length + '</p>';

        // Tambahkan feedback atau penjelasan tambahan
        if (score === answers.length) {
          resultDiv.innerHTML += '<p class="feedback">Pekerjaan yang bagus! Semua jawaban Anda benar.</p>';
        } else {
          resultDiv.innerHTML += '<p class="feedback">Tetap semangat! Ada beberapa jawaban yang masih perlu diperbaiki.</p>';
        }
      }
    </script>
  </div>
</body>
</html>


@endsection
