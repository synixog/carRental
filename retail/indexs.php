<?php session_start(); ?>
<?php include '../layout/head.php'; ?>
<?php include '../layout/navbar.php'; ?>
<?php include 'sidebars.php'; ?>

<main id="main" class='main'>
    <section>
        <div class="container w-50 shadow p-3 rounded-2">
            <form method="POST">
                <?php
                    $conn = new mysqli('localhost', 'root', '', 'synix');
                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }
                    if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $user_id = $_SESSION['retailer_id'];
                        $car_id = $id;
                        if (isset($_POST['start_date'])) {
                            $start_date = $_POST['start_date'];
                        } else {
                            $start_date = null; // or set a default value
                            echo "Start date is missing!";
                        }
                        $end_date = $_POST['end_date'];

                        if(!empty($start_date) && !empty($end_date)) {
                            $insert = mysqli_query($conn, "INSERT INTO rentalrequests(user_id, car_id, start_date, end_date)
                            VALUES('$user_id', '$car_id', '$start_date', '$end_date')");
                            if($insert) {
                                echo "<div class='alert alert-success'>Rental Request Submitted</div>";
                                echo "<meta http-equiv=\"refresh\" content=\"1;URL=../retailer.php\">";
                            } else {
                                echo "<div>Rental Request not Submitted Try again</div>";
                            }
                        }
                    }
                ?>
              <div class="mb-3">
                <label for="user_id" class="form-label">User ID:</label>
                <input type="number" class="form-control" id="user_id" placeholder="Automatically field by browser" class='user_id' >
              </div>
              <div class="mb-3">
                <label for="car_id" class="form-label">Car ID:</label>
                <input type="number" class="form-control" class="car_id" id="car_id" value="Dont fill">
              </div>
              <div class="mb-3">
                <label for="start_date" class="form-label">Start Date: </label>
                <input type="date" class="form-control" name="start_date" id="start_date" required>
              </div>
              <div class="mb-3">
                <label for="end_date" class="form-label">End Date: </label>
                <input type="date" class="form-control" name="end_date" id="end_date" required>
              </div>
             <div class="text-center">
             <button type="submit" class="btn btn-primary">Submit Request</button>
             </div>
            </form>
            </div>
        </section>
    </form>
</main>

<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php include '../layout/footer.php'; ?>