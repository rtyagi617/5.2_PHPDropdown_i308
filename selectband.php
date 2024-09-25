<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Select Band</title>
        <link rel="stylesheet" href="selectband.css">
</head>
<body>
<h1>Band Names</h1><br><br>

<form action = "bandinfo.php" method ="post">
        <select name = "form-name">
                <?php
                        $con = mysqli_connect("db.luddy.indiana.edu","i308s24_team68","my+sql=i308s24_team68","i308s24_team68");
                        if (!$con) { die("Connection failed: " . mysqli_connect_error());}
                        $sql = "SELECT DISTINCT title FROM p_band ORDER BY title ASC";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                                echo  "<option>" . $row['title'] . "</option>";
                        }
                ?>
        </select>
                <br><br>
                <input type="submit">
    </form>
</body>
</html>


