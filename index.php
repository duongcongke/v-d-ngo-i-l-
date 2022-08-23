<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">News Details</h2>
                    <a href="create.php" class="btn btn-success pull-right">Add</a>
                </div>
                <?php
                require_once 'config.php';

                $sql = "SELECT * FROM news";
                if ($result = mysqli_query($connection, $sql)){
                    if (mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";

                        echo "<th>Id</th>";
                        echo "<th>Title</th>";
                        echo "<th>CreateAt</th>";
                        echo "<th>Descriptions</th>";
                        echo "<th>Content</th>";
                        echo "<th>Avt</th>";
                        echo "<th>Views</th>";
                        echo "<th>Author</th>";

                        echo "</tr>";
                        echo "</thead>";

                        echo "<tbody>";
                        while ($row = mysqli_fetch_row($result)){
                            echo "<tr>";

                            echo "<td>" .$row[0] ."</td>";
                            echo "<td>" .$row[1] ."</td>";
                            echo "<td>" .$row[2] ."</td>";
                            echo "<td>" .$row[3] ."</td>";
                            echo "<td>" .$row[4] ."</td>";
                            echo "<td>" .$row[5] ."</td>";
                            echo "<td>" .$row[6] ."</td>";
                            echo "<td>" .$row[7] ."</td>";

                            echo "<td>";
//
                            echo "<a href='read.php?id='". $row[0] ."title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                            echo "<a href='update.php?id='". $row[0] ."title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                            echo "<a href='delete.php?id='". $row[0] ."title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
//
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        mysqli_free_result($result);
                    }else {
                        echo "<p class='lead'><em>No records were found</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. ".mysqli_error($connection);
                }
                //                                    mysql_close($connection);
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>