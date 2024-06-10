<?php
include("connection.php");

$sql = "SELECT student_name, student_class, student_phone, file_path, upload_time FROM student_uploads ORDER BY upload_time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Uploaded Files</title>
</head>
<body>
    <div class="container sm-5">
        <h2>Uploaded Files</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student Class</th>
                    <th>Student Phone</th>
                    <th>File</th>
                    <th>Upload Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["student_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["student_class"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["student_phone"]) . "</td>";
                        echo "<td><a href='" . htmlspecialchars($row["file_path"]) . "' target='_blank'>View File</a></td>";
                        echo "<td>" . htmlspecialchars($row["upload_time"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No files uploaded yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3iomkc5jLl6CvNdrWl6gkB0fUs2J" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
