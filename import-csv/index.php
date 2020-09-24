<?php

use Phppot\DataSource;
use Illuminate\Database\Capsule\Manager as DB;

require_once(__DIR__ . '/../bootstrap.php');
require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        DB::statement('DELETE FROM card');

        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

            $category_id = "";
            if (isset($column[0])) {
                $category_id = mysqli_real_escape_string($conn, $column[0]);
            }
            $card_id = "";
            if (isset($column[1])) {
                $card_id = mysqli_real_escape_string($conn, $column[1]);
            }
            $manager_name = "";
            if (isset($column[2])) {
                $manager_name = mysqli_real_escape_string($conn, $column[2]);
            }
            $manager_phone = "";
            if (isset($column[3])) {
                $manager_phone = mysqli_real_escape_string($conn, $column[3]);
            }
            $car_mark = "";
            if (isset($column[4])) {
                $car_mark = mysqli_real_escape_string($conn, $column[4]);
            }
            $car_number = "";
            if (isset($column[5])) {
                $car_number = mysqli_real_escape_string($conn, $column[5]);
            }
            $user_name = "";
            if (isset($column[6])) {
                $user_name = mysqli_real_escape_string($conn, $column[6]);
            }
            $user_lastname = "";
            if (isset($column[7])) {
                $user_lastname = mysqli_real_escape_string($conn, $column[7]);
            }
            $user_surname = "";
            if (isset($column[8])) {
                $user_surname = mysqli_real_escape_string($conn, $column[8]);
            }
            $user_phone = "";
            if (isset($column[9])) {
                $user_phone = mysqli_real_escape_string($conn, $column[9]);
            }
            $until = "";
            if (isset($column[10])) {
                $until = mysqli_real_escape_string($conn, $column[10]);
            }

            $sqlInsert = "INSERT into card (category,card_id,manager_name,manager_phone,car_mark,car_number,user_name,user_lastname,user_surname,user_phone,until)
                   values (?,?,?,?,?,?,?,?,?,?,?)";
            $paramType = "sssssssssss";
            $paramArray = array(
                $category_id,
                $card_id,
                $manager_name,
                $manager_phone,
                $car_mark,
                $car_number,
                $user_name,
                $user_lastname,
                $user_surname,
                $user_phone,
                $until,
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

            if (!empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data" . $sqlInsert;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <script src="jquery-3.2.1.min.js"></script>

    <style>
        body {
            font-family: Arial;
            width: 550px;
        }

        .outer-scontainer {
            background: #F0F0F0;
            border: #e0dfdf 1px solid;
            padding: 20px;
            border-radius: 2px;
        }

        .input-row {
            margin-top: 0px;
            margin-bottom: 20px;
        }

        .btn-submit {
            background: #333;
            border: #1d1d1d 1px solid;
            color: #f0f0f0;
            font-size: 0.9em;
            width: 100px;
            border-radius: 2px;
            cursor: pointer;
        }

        .outer-scontainer table {
            border-collapse: collapse;
            width: 100%;
        }

        .outer-scontainer th {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .outer-scontainer td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        #response {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 2px;
            display: none;
        }

        .success {
            background: #c7efd9;
            border: #bbe2cd 1px solid;
        }

        .error {
            background: #fbcfcf;
            border: #f3c6c7 1px solid;
        }

        div#response.display-block {
            display: block;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmCSVImport").on("submit", function () {

                $("#response").attr("class", "");
                $("#response").html("");
                var fileType = ".csv";
                var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
                if (!regex.test($("#file").val().toLowerCase())) {
                    $("#response").addClass("error");
                    $("#response").addClass("display-block");
                    $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
                    return false;
                }
                return true;
            });
        });
    </script>
</head>

<body>
<h2>Import CSV file into Mysql using PHP</h2>

<div id="response"
     class="<?php if (!empty($type)) {
         echo $type . " display-block";
     } ?>">
    <?php if (!empty($message)) {
        echo $message;
    } ?>
</div>
<div class="outer-scontainer">
    <div class="row">

        <form class="form-horizontal" action="" method="post"
              name="frmCSVImport" id="frmCSVImport"
              enctype="multipart/form-data">
            <div class="input-row">
                <label class="col-md-4 control-label">Choose CSV
                    File</label> <input type="file" name="file"
                                        id="file" accept=".csv">
                <button type="submit" id="submit" name="import"
                        class="btn-submit">Import
                </button>
                <br/>

            </div>

        </form>

    </div>
    <?php
    $sqlSelect = "SELECT * FROM card";
    $result = $db->select($sqlSelect);
    if (!empty($result)) {
        ?>
        <table id='userTable'>
            <thead>
            <tr>
                <th>id</th>
                <th>category</th>
                <th>card id</th>
                <th>manager_name</th>
                <th>manager_phone</th>
                <th>car_mark</th>
                <th>car_number</th>
                <th>user_name</th>
                <th>user_lastname</th>
                <th>user-surname</th>
                <th>user_phone</th>
                <th>until</th>
            </tr>
            </thead>
            <?php
            foreach ($result

            as $row) {
            ?>
            <tbody>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['card_id']; ?></td>
                <td><?php echo $row['manager_name']; ?></td>
                <td><?php echo $row['manager_phone']; ?></td>
                <td><?php echo $row['car_mark']; ?></td>
                <td><?php echo $row['car_number']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['user_lastname']; ?></td>
                <td><?php echo $row['user_surname']; ?></td>
                <td><?php echo $row['user_phone']; ?></td>
                <td><?php echo $row['until']; ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

</body>

</html>