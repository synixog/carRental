<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
  .container {
  max-width: 1200px;
  margin: 0 auto;
  }

h1 {
  text-align: center;
  margin-bottom: 40px;
}

.training-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
}

.card {
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  transition: transform 0.2s;
  text-align: center;
}

.card:hover {
  transform: translateY(-5px);
}

.course-image {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 15px;
}

.card h2 {
  font-size: 1.5em;
  margin-bottom: 10px;
}

.card p {
  margin-bottom: 8px;
  color: #555;
}

.card p strong {
  color: #333;
}

/* Responsive Design */
@media (min-width: 768px) {
  .training-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 1024px) {
  .training-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}
</style>

</head>

<body>
<?php include '../layout/navbar.php'; ?>
<?php include 'sidebars.php'; ?>

<main class="main" id="main">

        <div class="container">
              <h1>Cars Details</h1>
              <div class="training-grid">
        <!-- <h3>Web Development</h3> -->
          <?php
          $conn = new mysqli("localhost", "root", "", "synix");
          if(isset($_GET['id'])) {
            $id = $_GET['id'];
          }
          $query = mysqli_query($conn, "SELECT * FROM cars WHERE car_id = '$id'");
          $car = mysqli_fetch_assoc($query);
          echo "<div class='card'>";
          echo "<img src='../upload/{$car['img']}' alt='{$car['model']}' class='course-image' />";
          echo "<h3>Name: {$car['name']}</h3>";
          echo "<h3>Model: {$car['model']}</h3>";
          echo "<p>Description: {$car['description']}</p>";
          echo "<h4>Price: {$car['price']}</h4>";
          echo "<a class='btn btn-info' href='indexs.php?id={$car['car_id']}'>Retail Car</a>";
          echo "</div>";
      ?>
    </div>
  </div>

</main>

<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php include '../layout/footer.php'; ?>