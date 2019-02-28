<?php
include("options.php");
?>
<html>
	<head>
		<title>School Journal Listening Post - version 2</title>
		<link href="/sjlp/style.css" rel="stylesheet">
		<meta name="robots" content="noindex" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/qrcode.js"></script>
		
		<?php
		//adjust the display cells for when qr codes aren't displayed...
		 if($qr_display == false) { ?>
		<style>
			ul.collection li.item p { width:320px; }
		</style>
		<?php } // end of qr_display?>
	</head>
		