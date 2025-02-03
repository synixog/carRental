<?php include '../layout/head.php'; ?>
<?php include '../layout/navbar.php'; ?>
<?php include '../layout/sidebar.php'; ?>


<main id="main" class="main">
    <section>
        <div class="container w-50 p-3 shadow rounded-lg">
        <form method="POST" enctype="multipart/form-data">

        <?php
$conn = new mysqli("localhost", "root", "", "synix");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
    // Validate and sanitize input
    $model = isset($_POST['model']) ? trim($_POST['model']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';

    // Handle file upload
    if (isset($_FILES['img'])) {
        $img = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];
        $size = $_FILES['img']['size'];

        // Get file extension
        $explode = explode('.', $img);
        $firstName = strtolower($explode[0]);
        $type = strtolower(end($explode));
        $imgName = $firstName . "." . $type;

        // Validate input fields
        if (!empty($model) && !empty($description) && !empty($price)) {
            if ($size <= 1024 * 1024 * 5) { // Check file size (5MB limit)
                if (in_array($type, ['jpg', 'jpeg', 'png', 'avif'])) { // Check file type
                    // Move uploaded file
                    if (move_uploaded_file($tmp, 'upload/' . $imgName)) {
                        // Prepare SQL statement to prevent SQL injection
                        $stmt = $conn->prepare("INSERT INTO cars (model, description, img, price) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("sssd", $model, $description, $imgName, $price); // 's' for string, 'd' for double

                        if ($stmt->execute()) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Car Added Successfully</div>';
                            echo "<meta http-equiv=\"refresh\" content=\"2;URL=carInfo.php\">";
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: ' . $stmt->error . '</div>';
                        }
                        $stmt->close();
                    } else {
                        echo "<div class='alert alert-warning'>Failed to upload the file</div>";
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">File type is not supported!</div>';
                }
            } else {
                echo "<div class='alert alert-warning'>Image size must be less than 5MB</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>Please fill in all fields.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>No file uploaded.</div>";
    }
}

$conn->close();
?>
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