<?php

include "config.php";

// Get LED history
$sql = "SELECT * FROM led_history ORDER BY id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LED History</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            text-align: center;
        }

        .header {
            padding: 30px 20px 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
        }

        .header p {
            color: #666;
            margin-top: 8px;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 25px auto;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #222;
            color: white;
            padding: 14px;
            font-size: 16px;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
        }

        tr:hover {
            background: #f7f7f7;
        }

        .on {
            color: green;
            font-weight: bold;
        }

        .off {
            color: red;
            font-weight: bold;
        }

        .back-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .back-btn:hover {
            background: #555;
        }

        .empty {
            padding: 30px;
            color: #777;
        }

    </style>

</head>

<body>

    <div class="header">

        <h1>📊 LED History</h1>

        <p>10 LED IoT Control System</p>

    </div>


    <div class="container">

        <?php if ($result && $result->num_rows > 0) { ?>

            <table>

                <tr>

                    <th>ID</th>

                    <th>LED</th>

                    <th>Status</th>

                    <th>Date & Time</th>

                </tr>


                <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>

                        <td>
                            <?php echo $row['id']; ?>
                        </td>

                        <td>
                            LED <?php echo $row['led_number']; ?>
                        </td>

                        <td>

                            <?php if ($row['status'] == 1) { ?>

                                <span class="on">ON</span>

                            <?php } else { ?>

                                <span class="off">OFF</span>

                            <?php } ?>

                        </td>

                        <td>
                            <?php echo $row['changed_at']; ?>
                        </td>

                    </tr>

                <?php } ?>

            </table>

        <?php } else { ?>

            <div class="empty">
                No LED history available.
            </div>

        <?php } ?>


        <a href="index.php" class="back-btn">
            ← Back to Dashboard
        </a>

    </div>

</body>

</html>