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
		<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />
		
		<title><?php echo $conf['SiteTitle']; ?></title>

		<link rel='stylesheet' href='css/semantic.min.css' type='text/css' />
		<link rel='stylesheet' href='css/style.css' type='text/css'>

		<script src='js/jquery.min.js'></script>
		<script src='js/semantic.min.js'></script>
		<script src='js/core.js'></script>
	</head>

<body>
	<div class="ui visible inverted left vertical sidebar menu">
		<div class="header item"><?php echo $conf['SiteTitle']; ?></div>
		<div class="ui horizontal divider"></div>
		<?php include('views/nav-sidebar.php'); ?>

	</div>

	<div id="container" class="ui">
	</div>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-87410597-3', 'auto');
		ga('send', 'pageview');
	</script>
</body>

</html>
