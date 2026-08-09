<?php

include "config.php";

if (isset($_POST['led']) && isset($_POST['status'])) {

    $led = intval($_POST['led']);
    $status = intval($_POST['status']);

    // Check valid LED number and status
    if ($led >= 1 && $led <= 10 && ($status == 0 || $status == 1)) {

        // Current status table
        $column = "led" . $led;

        // Update current LED status
        $sql = "UPDATE led_status 
                SET $column = $status 
                WHERE id = 1";

        if ($conn->query($sql)) {

            // Save ON/OFF history
            $historySql = "INSERT INTO led_history 
                           (led_number, status) 
                           VALUES ($led, $status)";

            if ($conn->query($historySql)) {

                echo "LED $led updated and history saved";

            } else {

                echo "LED updated but history failed";
            }

        } else {

            echo "Update failed";
        }

    } else {

        echo "Invalid LED or status";
    }
}

?>