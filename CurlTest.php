<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="css/roncabeanz_style.css" type="text/css" />
    <link href="css/Header.css" rel="stylesheet" type="text/css">

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }


        }
    </style>
</head>
<body>

<?php
    include_once 'lib/CurlHelper.php';

    $ch = new CurlHelper();
    $url = "http://roncabeanz.com/Roncabeanz/ReadUsers.php";
    $result = $ch->get($url);

    $data =  json_decode($result, TRUE); ?>

<table>
    <?php

        if(count($data) > 0) {
            // first get headers
            $row = $data[0];
            $ak = array_keys($row);
            ?>

            <tr>
                <?php
                foreach ($ak as $key) { ?>
                    <th><?php echo $key; ?></th>
                <?php } ?>
            </tr>
            <?php foreach ($data as $row) { ?>
                <tr> <?php
                    foreach ($row as $col) { ?>
                            <td><?php echo $col ?></td>
                            <?php
                    } ?>
                <tr> <?php
            }
        }
    ?>


</body>
</html>