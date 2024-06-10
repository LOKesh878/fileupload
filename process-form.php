<?php
session_start();
include("connection.php");

if (isset($_POST['save_stu_img'])) {
    $stu_name = $_POST['stu_name'];
    $stu_class = $_POST['stu_class'];
    $stu_phone = $_POST['stu_phone'];
    $stu_img = $_FILES['stu_img'];

    // Validate form data and file upload
    if (!empty($stu_name) && !empty($stu_class) && !empty($stu_phone) && !empty($stu_img['name'])) {
        // Directory where the file will be uploaded
        $target_dir = "uploads/";
        // Path of the file to be uploaded
        $target_file = $target_dir . basename($stu_img["name"]);
        $uploadOk = 1;

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION['status'] = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($stu_img["size"] > 5000000) {
            $_SESSION['status'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $_SESSION['status'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['status'] = "Sorry, your file was not uploaded.";
        } else {
            // Try to upload the file
            if (move_uploaded_file($stu_img["tmp_name"], $target_file)) {
                // Insert file information into the database
                $stmt = $conn->prepare("INSERT INTO student_uploads (student_name, student_class, student_phone, file_path) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $stu_name, $stu_class, $stu_phone, $target_file);

                if ($stmt->execute()) {
                    $_SESSION['status'] = "The file " . htmlspecialchars(basename($stu_img["name"])) . " has been uploaded.";
                } else {
                    $_SESSION['status'] = "Sorry, there was an error uploading your file.";
                }

                $stmt->close();
            } else {
                $_SESSION['status'] = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $_SESSION['status'] = "All fields are required.";
    }

    // Redirect back to the form page
    header("Location: display.php");
    exit();
}

$conn->close();
?>
