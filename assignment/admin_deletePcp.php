<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'dbConn.php';
    session_start();

    if (isset($_GET['prjID']) && isset($_GET['userID'])) {
        $prjID = $_GET['prjID'];
        $userID = $_GET['userID'];

        $sql = "DELETE FROM tblparticipants WHERE prjID = '$prjID' AND userID = '$userID'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Participant removed successfully!');
                    window.location.href='admin_viewPcp.php?prjID=$prjID';
                  </script>";
        } else {
            echo "Error deleting participant: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
                alert('Invalid request. Missing project or user ID.');
                window.location.href='admin_activities.php';
              </script>";
    }

?>
