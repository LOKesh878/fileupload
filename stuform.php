<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>File Upload</title>
</head>
<body>
    <div class="container sm-5">
        <?php
        if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?php echo htmlspecialchars($_SESSION['status']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION["status"]);
        }
        ?>

        <form action="process-form.php" method="POST" enctype="multipart/form-data" class="form-control-sm">
            <div class="form-group">
                <label for="exampleInputEmail1">Student Name:</label>
                <input type="text" class="form-control" name="stu_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="exampleInputClass">Student Class:</label>
                <input type="text" class="form-control" name="stu_class" id="exampleInputClass" placeholder="Enter class">
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">Student Phone:</label>
                <input type="text" class="form-control" name="stu_phone" id="exampleInputPhone" placeholder="Enter phone">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Student Image:</label>
                <input type="file" class="form-control-file" name="stu_img" id="exampleFormControlFile1">
            </div>
            <button type="submit" name="save_stu_img" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3iomkc5jLl6CvNdrWl6gkB0fUs2J" crossorigin="anonymous"></script>
</body>
</html>
