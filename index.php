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
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
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
<?php include 'layout/navbar.php'; ?>
<?php include 'layout/sidebar.php'; ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Cars</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-car-front-fill"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'synix');
                    $query = mysqli_query($conn, "SELECT COUNT(car_id) AS totalCar FROM cars");
                    $car = mysqli_fetch_assoc($query);
                    echo "<h3>{$car['totalCar']}</h3>"
                    ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Retailers</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'synix');
                    $query = mysqli_query($conn, "SELECT COUNT(request_id) AS totalRequest FROM rentalrequests");
                    $car = mysqli_fetch_assoc($query);
                    echo "<h3>{$car['totalRequest']}</h3>"
                    ?>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
            <!-- <h1>Your Cars </h1> -->
            <div class="container">
              <h1>Your Cars</h1>
              <div class="training-grid">
        <!-- <h3>Web Development</h3> -->
          <?php
           $fetch = mysqli_query($conn, "SELECT * FROM cars");
            $sql = mysqli_fetch_all($fetch, MYSQLI_ASSOC);
            foreach ($sql as $car) {
            echo "<div class='card'>";
            echo "<img src='upload/{$car['img']}' alt='{$car['model']}' class='course-image' />";
            echo"<h2>{$car['model']}</h2>";
            echo "<p><strong>Duration:</strong> {$car['price']}</p>";
            echo "<a class='btn btn-primary' href='cars/updateInfo.php'>Edit Car Info</a>";
            echo "</div>";
        }
      ?>
    </div>
  </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>