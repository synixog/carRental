<?php include '../layout/head.php'; ?>
<?php include '../layout/navbar.php'; ?>
<?php include '../layout/sidebar.php'; ?>


<main id="main" class="main">
    <section>
        <div class="container w-50 p-3 shadow rounded-lg">
        <form method="POST" enctype="multipart/form-data">
            <?php
                $conn = new mysqli('localhost', 'root', '', 'synix');

                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['name'];
                    $model = $_POST['model'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];

                    $img = $_FILES['img']['name'];
                    $tmp = $_FILES['img']['tmp_name'];
                    $size = $_FILES['img']['size'];

                    $explode = explode('.', $img);
                    $firstName = strtolower($explode[0]);
                    $type = strtolower(end($explode));
                    $imgName = $firstName ."." . $type;

                    if(!empty($model) && !empty($description) && !empty($price) && !empty($img)) {
                        if($size <= 1024 * 1024 * 5) {
                            if(in_array($type, ['jpg', 'jpeg', 'png', 'avif'])) {
                                if(move_uploaded_file($tmp, '../upload/' . $imgName)) {
                                    $sql = mysqli_query($conn, "INSERT INTO cars(name, model, description, img, price) VALUES('$name', '$model', '$description', '$imgName', '$price')");
                                    if($sql) {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Car Rented Sucessfully</div>';
                                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=../index.php\">";
                                    }
                                } else {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error....</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">File type is not supported!</div>';
                            }
                        } else {
                            echo "<div class='alert alert-warning'>Image size must be less than 5MB</div>";
                        }
                }
                }
            ?>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="mb-3">
              <label for="input1" class="form-label">Model</label>
              <input type="text" class="form-control" name="model" id="model" aria-describedby="textHelp" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="a df" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
              <label for="input1" class="form-label">Chooses a image for car</label>
              <input class="form-control" type="file" name="img" id="input2" multiple required>
            </div>

            <div class="mb-3">
              <label for="input1" class="form-label">Price</label>
              <input type="text" class="form-control" id="price" name="price" aria-describedby="textHelp" required>
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