<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
session_unset(); 
session_destroy(); 
header("refresh:0; url=index.php");
?>

</body>
</html>
