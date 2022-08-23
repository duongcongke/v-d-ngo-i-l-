<?php

require_once 'config.php';

$title = $createAt = $description = $content = $avt = $views = $author ="";
$title_err = $createAt_err = $description_err = $content_err = $avt_err = $views_err = $author_err ="";

if (isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
// Title Input
    $input_title = trim($_POST["title"]);
    if (empty($input_title)){
        $title_err = "Please enter a title.";
    } else{
        $title = $input_title;
    }
// createAt Input
    $input_createAt = trim($_POST["createAt"]);
    if (empty($input_createAt)){
        $createAt_err = "Please enter a createAt.";
    } else{
        $createAt = $input_createAt;
    }
// description Input
    $input_description = trim($_POST["description"]);
    if (empty($input_description)){
        $description_err = "Please enter a description.";
    } else{
        $description = $input_description;
    }
// content Input
    $input_content = trim($_POST["content"]);
    if (empty($input_content)){
        $content_err = "Please enter a content.";
    } else{
        $content = $input_content;
    }
//    views Input
    $input_views = trim($_POST["views"]);
    if (empty($input_views)){
        $views_err = "Please enter the views news.";
    } elseif (!ctype_digit($input_views)){
        $views_err = 'Please enter a positive integer value.';
    } else{
        $views = $input_views;
    }
// author Input
    $input_author = trim($_POST["author"]);
    if (empty($input_author)){
        $author_err = "Please enter a author.";
    } else{
        $author = $input_author;
    }


    if (empty($title_err) && empty($createAt_err) && empty($description_err) && empty($content_err) && empty($avt_err) && empty($views_err) && empty($author_err)){
        $sql = "UPDATE news SET title=?, createAt=?, descriptions=?, content=?, avt=?, views=?, author=? WHERE id=?";

        if ($stmt = mysqli_prepare($connection, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $param_title, $param_createAt, $param_descriptions, $param_content, $param_avt, $param_views, $param_author, $param_id);

            $param_title = $title;
            $param_createAt = $createAt;
            $param_descriptions = $description;
            $param_content = $content;
            $param_avt = $avt;
            $param_views = $views;
            $param_author = $author;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
} else{
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM news WHERE id=?";
        if ($stmt = mysqli_prepare($connection, $sql)){

            mysqli_stmt_bind_param($stmt, "i", $id);
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1){

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $title = $row["title"];
                    $createAt = $row["createAt"];
                    $descriptions = $row["descriptions"];
                    $content = $row["content"];
                    $avt = $row["avt"];
                    $views = $row["views"];
                    $author = $row["author"];
                } else {

                    header("location: error.php");
                    exit();
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
    } else {
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2>Update Record</h2>
                </div>
                <p>Please edit the input values and submit to update the record to the database.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($title_err))? 'has-error' : '';?>">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                        <span class="help-block"><?php echo $title_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($createAt_err))? 'has-error' : '';?>">
                        <label>CreateAt</label>
                        <input type="text" name="createAt" class="form-control" value="<?php echo $createAt; ?>">
                        <span class="help-block"><?php echo $createAt_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($description_err))? 'has-error' : '';?>">
                        <label>Descriptions</label>
                        <input type="text" name="descriptions" class="form-control" value="<?php echo $description; ?>">
                        <span class="help-block"><?php echo $description_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($content_err))? 'has-error' : '';?>">
                        <label>Content</label>
                        <input type="text" name="content" class="form-control" value="<?php echo $content; ?>">
                        <span class="help-block"><?php echo $content_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($avt_err))? 'has-error' : '';?>">
                        <label>Avt</label>
                        <input type="text" name="avt" class="form-control" value="<?php echo $avt; ?>">
                        <span class="help-block"><?php echo $avt_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($views_err))? 'has-error' : '';?>">
                        <label>Views</label>
                        <input type="text" name="views" class="form-control" value="<?php echo $views; ?>">
                        <span class="help-block"><?php echo $views_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($author_err))? 'has-error' : '';?>">
                        <label>Author</label>
                        <input type="text" name="author" class="form-control" value="<?php echo $author; ?>">
                        <span class="help-block"><?php echo $author_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>