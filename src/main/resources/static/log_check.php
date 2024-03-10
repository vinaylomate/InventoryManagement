<?php
session_start();
if(!isset($_SESSION['uId']) && !isset($_SESSION['uRole']) && !isset($_SESSION['uAccess']) && !isset($_SESSION['cmpId'])&& !isset($_SESSION['iType'])&& !isset($_SESSION['loc']) && !isset($_SESSION['locType']))
{
	echo '<script>window.location.href="index.php"</script>';
}
?>