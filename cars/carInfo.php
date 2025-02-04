<?php include '../layout/head.php'; ?>
<?php include '../layout/navbar.php'; ?>
<?php include '../layout/sidebar.php'; ?>

<main id='main' class="main">
<section class="py-5">
        <div class="container">
            <h4>Course List</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Model</th>
                        <th>Description</th>
                        <th>Imgaes</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $conn = new mysqli('localhost', 'root', '', 'synix');
                        $sql = mysqli_query($conn, "SELECT * FROM cars");
                        $cars = mysqli_fetch_all($sql, MYSQLI_ASSOC);  
                        
                        if(isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $sql = mysqli_query($conn, "DELETE FROM cars WHERE car_id = '$id'");
                            if($sql) {
                                echo "<div class='alert alert-success'>Delete car Success</div>";
                                echo "<meta http-equiv=\"refresh\" content=\"1;URL=carInfo.php\">";    
                            } else {
                                echo "<div class='alert alert-danger'>Delete Course Failed</div>";
                            }
                        }
                        foreach ($cars as $car) {
                            echo "<tr>";
                            echo "<td>" . $car['car_id'] . "</td>";
                            echo "<td>" . $car['model'] . "</td>";
                            echo "<td>" . $car['description'] . "</td>";
                            echo "<td><img src='../upload/{$car['img']}' style='width: 40%; height: 50%'/></td>";
                            echo "<td>" . $car['price'] . "</td>";
                            echo "<td>
                                <a href='updateInfo.php?id={$car['car_id']}' class='btn btn-primary'>Edit</a>
                                <a href='carInfo.php?id={$car['car_id']}' class='btn btn-danger'>Delete</a>
                            </td>";
                            }
                            $conn -> close();
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>


<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php include '../layout/footer.php'; ?>