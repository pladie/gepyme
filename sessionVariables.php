<?php
session_start();
// Set session variables
$_SESSION["favcolor"] = "green";
?>
<!DOCTYPE html>
<html>
<body>

<?php
print_r($_SESSION);
echo "<br>";
echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";

?>

</body>
</html>