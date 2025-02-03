<?php include '../layout/head.php'; ?>
<?php include '../layout/navbar.php'; ?>
<?php include '../layout/sidebar.php'; ?>


<main id="main" class="main">
    <section>
        <div class="container w-50 p-3 shadow rounded-lg">
        <form method="POST" enctype="multipart/form-data">
        <?php
            $conn = new mysqli("localhost", "root", "", "synix");
            if(isset($_GET['car_id'])) {
                $id = $_GET['car_id'];
                $query = mysqli_query($conn, "SELECT * FROM car WHERE car_id = '$id'");
                $car = mysqli_fetch_assoc($query);
                if(!$car) {
                    echo "<div class='alert alert-warning'>Course not found</div>";
                    exit();
                }
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $model = $_POST['model'];
                $description = $_POST['descripion'];
                $price = $_POST['price'];
            }
 

$conn->close();
?>

            <div class="mb-3">
              <label for="input1" class="form-label">Model</label>
              <input type="text" class="form-control" name="model" value="<?php echo htmlspecialchars($car['model']); ?>" id="model" aria-describedby="textHelp" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" name="description" value="<?php echo htmlspecialchars($car['description']); ?>" id="a df" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
              <label for="input1" class="form-label">Chooses a image for car</label>
              <input class="form-control" type="file" name="img" value="<?php echo htmlspecialchars($car['img']); ?>" id="input2" multiple required>
            </div>

            <div class="mb-3">
              <label for="input1" class="form-label">Price</label>
              <input type="text" class="form-control" id="price" value="<?php echo htmlspecialchars($car['price']); ?>" name="price" aria-describedby="textHelp" required>
            </div>

            <label for="availability">Availability:</label>
    <select name="availability" id="availability">
        <option value="1">Available</option>
        <option value="0">Not Available</option>
    </select>
                
          <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
        </div>
    </section>
</main>


<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php include '../layout/footer.php'; ?>