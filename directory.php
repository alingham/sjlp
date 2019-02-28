<?php
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
else {
	$dir    = 'SchoolJournal-Level2';
}
if(isset($_GET['cat'])){
	$cat = $_GET['cat'];
	$cat = str_replace('%20', ' ', $cat);
}
else {
	$cat = 'School Journal';
}
//update dir to match new folder structure. 
$dir = "audio/" . $dir;

function getCapitalLetters($str)

{

  if(preg_match_all('#([A-Z]+)#',$str,$matches))

    return implode('',$matches[1]);

  else

    return false;

}

$preimg = getCapitalLetters($cat);

$files = array_diff(scandir($dir, 1), array('..', '.'));

 function after_last ($this, $inthat)
    {
        if (!is_bool(strrevpos($inthat, $this)))
        return substr($inthat, strrevpos($inthat, $this)+strlen($this));
    };
 function before_last ($this, $inthat)
    {
        return substr($inthat, 0, strrevpos($inthat, $this));
    };
  function strrevpos($instr, $needle)
	{
    	$rev_pos = strpos (strrev($instr), strrev($needle));
    	if ($rev_pos===false) return false;
    	else return strlen($instr) - $rev_pos - strlen($needle);
	};
 function between_last ($this, $that, $inthat)
    {
     return after_last($this, before_last($that, $inthat));
    };
	
?>


<?php include('header.php') ?>
		
		
<body>
	<div id="content-wrapper">
	<h1>School Journal Listening Post</h1>
	<p><?php echo '<span class="categoryname">' . $cat .'</span>  -   <span class="dir">'. $dir . '</span>'; ?></p>
	<p><a href="index.php">Back</a></p>
	<?php
	$disptitle = between_last('/', '/', $dir);
	echo "<h2>" . $disptitle . "</h2>";
	$i = 0;
	echo "<ul class=\"collection\">";
	foreach ($files as $file) {
		
		//========================================READY TO READ===============================================//
		if($cat == "Ready to Read"){
			$i++;
			$year = substr($file, 3, 4);
			$title = substr($file, 10, -4);
			$colour = $disptitle;
			$link = "/sjlp/" . $dir . $file;
			$imglink = "/sjlp/images/ReadytoRead/" . $preimg . "-" . $year . " - " . $colour . " - " . $title . ".jpg";
			
		//Create List Item	
			echo "<li class=\"item\">";
			//Display QR Code
			if($qr_display == true) {
				echo "<div id=\"qrcode-". $i ."\" class=\"QR\"></div>
				<script type=\"text/javascript\">
				new QRCode(document.getElementById(\"qrcode-". $i ."\"), { width:120, height:120, text:\"". $_SERVER['HTTP_HOST'] . $link . "\"} );
				</script>";
			} //end if qr_display
			
			echo "<a href=\"" . $link . "\">
				<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
				<span class=\"book-title\"><a href=\"" . $link . "\">" . $title . "</a> - (" . $year . ")</span></p></li>";
		} 
		
		//========================================JUNIOR JOURNAL===============================================//
		else if($cat == "Junior Journal"){
			$i++;
			$number = substr($file, 3, 2);
			$title = substr($file, 6,-4);
			$link = "/sjlp/" . $dir . "/" . $file;
			$imglink = "/sjlp/images/JuniorJournal/" . $preimg . "-" . $number . ".jpg";
		//Create List item	
			echo "<li class=\"item\">";
			
				//Display QR Code
				if($qr_display == true) {
					echo "<div id=\"qrcode-". $i ."\" class=\"QR\"></div>
					<script type=\"text/javascript\">
					new QRCode(document.getElementById(\"qrcode-". $i ."\"), { width:120, height:120, text:\"". $_SERVER['HTTP_HOST'] . $link . "\"} );
					</script>";
				} //end of if qr_display
				echo "<a href=\"" . $link . "\">
					<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
					<p>" . $cat . " Number " . $number . "<br /> 
					<a href=\"" . $link . "\">" . $title . "</a></p></li>";
		}
		
		
		//========================================SCHOOL JOURNAL - LEVEL 2===============================================//
		else if($cat == "School Journal Level 2"){
			$i++;
			$year = substr($file, 8, 2);	
			$month = substr($file, 11, 2);
			$title = substr($file, 14,-4);
			$link = "/sjlp/" . $dir . "/" . $file;
			$imglink = "/sjlp/images/SchoolJournal-Level2/SJ-L2-" . $year . "-" . $month .".jpg";
			echo "<li class=\"item\">";
			
			//Display QR Code
			if($qr_display == true) {
				echo "<div id=\"qrcode-". $i ."\" class=\"QR\"></div>
				<script type=\"text/javascript\">
				new QRCode(document.getElementById(\"qrcode-". $i ."\"), { width:120, height:120, text:\"" . $_SERVER['HTTP_HOST'] . $link . "\"} );
				</script>";
			}//end of if qr_display
				echo "<a href=\"" . $link . "\">
					<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
					<p>" . $cat . "<br /> 
					20" . $year . "<br />
					<a href=\"" . $link . "\">" . $title . "</a></p></li>";
		}
		//========================================STORY LIBRARY===============================================//
		else if($cat == "Story Library") {
			$i++;
			$title = substr($file, 3,-4);
			$number = substr($dir, 37, 1);
			$link = "/sjlp/" . $dir . "/" . $file;
			$imglink = "/sjlp/images/SchoolJournal-StoryLibrary/SJSL-" . $number . " - " . $title .".jpg";
			echo "<li class=\"item\">";
			
			//Display QR Code
			if($qr_display == true) {
				echo "<div id=\"qrcode-". $i ."\" class=\"QR\"></div>
				<script type=\"text/javascript\">
				new QRCode(document.getElementById(\"qrcode-". $i ."\"), { width:120, height:120, text:\"" . $_SERVER['HTTP_HOST'] . $link . "\"} );
				</script>";
			}//end if qr_display
					echo "<a href=\"" . $link . "\">
					<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
					<p>" . $cat . "<br /> 
					<a href=\"" . $link . "\">" . $title . "</a></p></li>";
		} 	
		
		//========================================SCHOOL JOURNAL===============================================//
		else if($cat == "School Journal") {
			$i++;
			$year = substr($file, 0, 2);
			$part = substr($file, 3, 1);
			$number = substr($file, 5, 1);
			$title = substr($file, 7, -4);
			$link = "/sjlp/" . $dir . "/" . $file;
			$imglink = "/sjlp/images/SchoolJournal-Parts/" . $preimg . "-Part" . $part . " - " . $year . "-" . $part . "-" . $number . ".jpg";
			echo "<li class=\"item\">";
			
			//Display QR Code
			if($qr_display == true) {
				echo "<div id=\"qrcode-". $i ."\" class=\"QR\"></div>
				<script type=\"text/javascript\">
				new QRCode(document.getElementById(\"qrcode-". $i ."\"), { width:120, height:120, text:\"" . $_SERVER['HTTP_HOST'] . $link . "\"} );
				</script>";
			}//end if qr_display
					echo "<a href=\"" . $link . "\">
					<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
					<p>" . $cat . "<br />
					Part " . $part . " Number " . $number . "<br /> 
					20" . $year . "<br />
					<a href=\"" . $link . "\">" . $title . "</a></p></li>";
		} 	
		
		
		// everything else...                                       
		else {
			$i++; 
			$year = substr($file, 0, 2);
			$part = substr($file, 3, 1);
			$number = substr($file, 5, 1);
			$title = substr($file, 7, -4);
			$link = "/sjlp/" . $dir . "/" . $file;
			$imglink = "/sjlp/images/" . $preimg . "-Part" . $part . " - " . $year . "-" . $part . "-" . $number . ".jpg";
			echo "<li class=\"item\">";
			//Display QR Code
			if($qr_display == true) {
				echo "<div id=\"qrcode-". $i ."\" class=\"QR\"></div>
				<script type=\"text/javascript\">
				new QRCode(document.getElementById(\"qrcode-". $i ."\"), { width:120, height:120, text:\"" . $_SERVER['HTTP_HOST'] . $link . "\"} );
				</script>";
			} //end of if qr_display
					echo "<a href=\"" . $link . "\">
					<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
					<p>" . $cat . "<br />
					Part " . $part . " Number " . $number . "<br /> 
					20" . $year . "<br />
					<a href=\"" . $link . "\">" . $title . "</a></p></li>";
		}
		
		
		
	} // end of For Loop
	
	echo "</ul>";
	?>	
		
		
<?php 
include('footer.php'); 
?>

