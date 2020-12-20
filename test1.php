<?php
    include_once "dbConn.php";
    if(isset($_POST['downloadSheet'])){
        $data = array();
        $fileName = "MyData.xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$fileName);
        header("Pragma: no-cache"); 
        header("Expires: 0");
        $heading = false;
        $query = "select * from user_details";
        $query2 = mysqli_query($con,$query);
        $i=0;
        while($row = mysqli_fetch_assoc($query2)){
            $data[] = $row;
        }
        if(!empty($data)){
            foreach ($data as $d) {
                if(!$heading){
                    echo implode("\t", array_keys($d)) . "\n";
                    $heading = true;
                }
                else{
                    echo implode("\t", array_values($d)) . "\n";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Test 2</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body{
                background-color: #dfdfdf;
            }
        </style>
    </head>
    <body>
        
        <div class="jumbotron">
            <div class="text-center">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <button class="btn btn-primary" name="downloadSheet">Download as Excel Sheet</button>
                </form>
            </div>
            <br/>
            <div class="container">
                <table class="table table-hover table-striped text-center">
                    <thead>
                        <tr>
                            <td>User ID</td>
                            <td>Username</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Gender</td>
                            <td>Password</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysqli_fetch_array($query2)){
                                ?>
                                <tr>
                                    <td><?php echo $row['user_id'];?></td>
                                    <td><?php echo $row['username'];?></td>
                                    <td><?php echo $row['first_name'];?></td>
                                    <td><?php echo $row['last_name'];?></td>
                                    <td><?php echo $row['gender'];?></td>
                                    <td><?php echo $row['password'];?></td>
                                    <td><?php echo $row['status'];?></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

