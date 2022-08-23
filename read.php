<?php

if (isset($_GET["id"]) && !empty($_GET["id"])){
    require_once 'config.php';

    $sql = "SELECT * FROM news WHERE id= ?";
    if ($stmt = mysqli_prepare($connection, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);
//echo 'ahihi';
        if (mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
//            var_dump($result);
            if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
//                var_dump($row);
//                $id = $row["id"];
                $title = $row["title"];
                $createAt = $row["createAt"];
                $description = $row["descriptions"];
                $content = $row["content"];
                $avt = $row["avt"];
                $views = $row["views"];
                $author = $row["author"];


            } else{
                header("location: error.php");
                exit();
            }
        } else{
            header("location: error.php");
            exit();
        }
    }
    mysqli_stmt_close($stmt);

    mysqli_close($connection);
} else {
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>View Record</h2>
                </div>
                <!--                <div class="form-group">-->
                <!--                    <label>Id</label>-->
                <!--                    <p class="form-control-static">--><?php //echo $row["id"]; ?><!--</p>-->
                <!--                </div>-->
                <div class="form-group">
                    <label>Title</label>
                    <p class="form-control-static"><?php echo $row["title"]?></p>
                </div>
                <div class="form-group">
                    <label>CreateAt</label>
                    <p class="form-control-static"><?php echo $row["createAt"]?></p>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <p class="form-control-static"><?php echo $row["descriptions"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <p class="form-control-static"><?php echo $row["content"]?></p>
                </div>
                <div class="form-group">
                    <label>Avt</label>
                    <p class="form-control-static"><?php echo $row["avt"]?></p>
                </div>
                <div class="form-group">
                    <label>Views</label>
                    <p class="form-control-static"><?php echo $row["views"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <p class="form-control-static"><?php echo $row["author"]?></p>
                </div>
                <a href="index.php" class="btn btn-primary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>