<?php
	require('../config.php');
    if(loggedIn()){
    	if(isset($_POST['action']) && isset($_POST['mediaid'])){
    		if($_POST['action'] == "like"){
    			$var = likeMedia($instagram, $_SESSION['access_token'], $_POST['mediaid']);
    			print_r($var);
    		}elseif($_POST['action'] == "unlike"){
    			$var = unlikeMedia($instagram, $_SESSION['access_token'], $_POST['mediaid']);
    			print_r($var);
    		}
    	}else{
    		include('views/content-nomedia.php');
    	}
    }else{
        include('views/content-notloggedin.php');
    }
?>