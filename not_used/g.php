<?php
include 'config/connect.php';


$query = "SELECT waterbody, city FROM trips WHERE waterbody = '" . mysql_real_escape_string($_GET['waterbody']) . "'";
$result = mysql_query($query);

$waterbody = ""; 
$city = ""; 
    
if ($row =  mysql_fetch_assoc($result)) {
    $waterbody = $row['waterbody']; 
    $city = $row['city']; 
}

mysql_free_result($result);
?>
<html>
<body>
<form>
waterbody: <input type="text" name="waterbody" value="<?php echo $waterbody?>">
city: <input type="text" name="city" value="<?php echo $city?>">
</form>
</body>
</html>