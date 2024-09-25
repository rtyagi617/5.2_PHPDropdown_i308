<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Band Details</title>
    <link rel="stylesheet" href="bandinfo.css">
</head>
<body>
<?php
$con = mysqli_connect("db.luddy.indiana.edu", "i308s24_team68", "my+sql=i308s24_team68", "i308s24_team68");
if (!$con) {
    echo "<p>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
} else {
    echo "<h1>Established Database Connection</h1>";
    $band_name = isset($_POST['form-name']) ? $_POST['form-name'] : '';

    $sql_band_info = "SELECT DISTINCT pb.year_formed AS year_formed, CONCAT(pa.fname, ' ', pa.lname) AS Artist_name
                      FROM p_member AS pm
                      JOIN p_artist AS pa ON pa.id = pm.artist_id
                      JOIN p_band AS pb ON pb.id = pm.band_id
                      WHERE pb.title = '$band_name'";

    $result_band_info = mysqli_query($con, $sql_band_info);
    if ($row = mysqli_fetch_assoc($result_band_info)) {
        echo "<h1>Band formed in: " . $row['year_formed'] . "</h1>";
        
        echo "<table>
              <tr>
                  <th>Band Members</th>
              </tr>";
        mysqli_data_seek($result_band_info, 0); 
        while ($row = mysqli_fetch_assoc($result_band_info)) {
            echo "<tr><td>" . $row['Artist_name'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No band member data available.</p>";
    }

    echo "<br>";

    $sql_albums = "SELECT pal.title AS Album_title, pal.pub_year AS Publish_year
                   FROM p_album AS pal
                   JOIN p_band AS pb ON pal.band_id = pb.id
                   WHERE pb.title = '$band_name'";

    $result_albums = mysqli_query($con, $sql_albums);
    if (mysqli_num_rows($result_albums) > 0) {
        echo "<table>
              <tr>
                  <th>Album Title</th>
                  <th>Publication Year</th>
              </tr>";
        while ($row = mysqli_fetch_assoc($result_albums)) {
            echo "<tr>
                  <td>{$row['Album_title']}</td>
                  <td>{$row['Publish_year']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No album data available for the selected band.</p>";
    }

    mysqli_close($con);
}
?>
</body>
</html>
