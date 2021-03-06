<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'config.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		
		<title><?php echo $conf['SiteTitle']; ?></title>

		<link rel='stylesheet' href='css/semantic.min.css' type='text/css' />
		<link rel='stylesheet' href='css/style.css' type='text/css'>
		<script src='js/jquery.min.js'></script>
		<script src='js/semantic.min.js'></script>
		<script src='js/core.js'></script>
		<script>var gaTrackerID = "<?PHP echo $conf['GoogleAnalyticsID']; ?>"</script>
	</head>

<body>
	<div class="ui sidebar inverted vertical left visible menu">
		<div class="header item"><?php echo $conf['SiteTitle']; ?></div>
		<?php include('views/nav-sidebar.php'); ?>
	</div>
	<div id="container" class="ui pusher">
	</div>
</body>

</html>

<!--

!-->
