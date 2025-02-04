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
                        <th>User Id</th>
                        <th>Car Id</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $conn = new mysqli('localhost', 'root', '', 'synix');
                        $fetch = mysqli_query($conn, "SELECT * FROM rentalrequests");
                        $info = mysqli_fetch_all($fetch, MYSQLI_ASSOC);

                        #For Approved
                        if(isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $query = mysqli_query($conn, "UPDATE rentalrequests SET status = 'Approved' WHERE request_id = '$id' ");
                        }

                        #For Rejection
                        if(isset($_GET['ids'])) {
                            $ids = $_GET['ids'];
                            $query = mysqli_query($conn, "UPDATE rentalrequests SET status = 'Rejected' WHERE request_id = '$ids'");
                        }

                        foreach ($info as $key) {
                            echo "<tr>";
                            echo "<td>{$key['request_id']}</td>";
                            echo "<td>{$key['user_id']}</td>";
                            echo "<td>{$key['car_id']}</td>";
                            echo "<td>{$key['start_date']}</td>";
                            echo "<td>{$key['end_date']}</td>";
                            echo "<td>
                                <a href='script.php?id={$key['request_id']}' class='btn btn-info'>Approved</a>
                                <a href='script.php?ids={$key['request_id']}' class='btn btn-danger'>Reject</a>
                            </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>


<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php include '../layout/footer.php'; ?>