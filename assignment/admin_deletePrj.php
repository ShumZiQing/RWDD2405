<?php
    include 'dbConn.php';

    if (isset($_GET['prjID'])) {
        $prjID = $_GET['prjID'];

        $sql = "DELETE FROM tblprojects WHERE prjID = '$prjID'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>
                    alert('Project deleted successfully!');
                    window.location.href = 'admin_activities.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error deleting project: " . mysqli_error($conn) . "');
                    window.location.href = 'admin_activities.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('No project selected for deletion.');
                window.location.href = 'admin_activities.php';
              </script>";
    }
?>
