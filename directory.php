<?php
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
else {
	$dir    = 'SchoolJournal-Parts1&2-CDTracks/SchoolJournalParts1&2-2001/';
}
if(isset($_GET['cat'])){
	$cat = $_GET['cat'];
	$cat = str_replace('%20', ' ', $cat);
}
else {
	$cat = 'School Journal';
}


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
	<h2><?php echo $cat .', '. $dir; ?></h2>
	<p><a href="index.php">Back</a></p>
	<?php
	$disptitle = between_last('/', '/', $dir);
	echo "<h2>" . $disptitle . "</h2>";
	
	echo "<ul class=\"collection\">";
	foreach ($files as $file) {
			
		if($cat == "Ready to Read"){
			$year = substr($file, 3, 4);
			$title = substr($file, 10, -4);
			$colour = $disptitle;
			$link = "/sjlp/" . $dir . $file;
			$QR = "/sjlp/images/QR/" . $colour . " - " . $title . ".jpg";
			$imglink = "/sjlp/images/" . $preimg . "-" . $year . " - " . $colour . " - " . $title . ".jpg";
			
			echo "<li class=\"item\">
				<img src=\"" . $QR. "\" width=120 height=120 alt=\"" . $title . " QR Code\" class=\"QR\" />
			<a href=\"" . $link . "\">
				<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
				<a href=\"" . $link . "\">" . $title . "</a> - (" . $year . ")</p></li>";
		} 
		else if($cat == "Junior Journal"){
			$number = substr($file, 6, 2);
			$title = substr($file, 9,-4);
			$link = "/sjlp/" . $dir . "/" . $file;
			$imglink = "/sjlp/images/" . $preimg . "-" . $number . ".jpg";
			echo "<li class=\"item\"><a href=\"" . $link . "\">
					<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
					<p>" . $cat . " Number " . $number . "<br /> 
					<a href=\"" . $link . "\">" . $title . "</a></p></li>";
		}
		else if($cat == "School Journal Level 2"){
			$year = substr($file, 8, 2);	
			$month = substr($file, 11, 2);
			$title = substr($file, 14,-4);
			$link = "/sjlp/" . $dir . "/" . $file;
			$imglink = "/sjlp/images/SJ-L2-" . $year . "-" . $month .".jpg";
			echo "<li class=\"item\"><a href=\"" . $link . "\">
					<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
					<p>" . $cat . "<br /> 
					20" . $year . "<br />
					<a href=\"" . $link . "\">" . $title . "</a></p></li>";
		}
		else if($cat == "Story Library") {
			$title = substr($file, 3,-4);
			$number = substr($dir, 37, 1);
			$link = "/sjlp/" . $dir . "/" . $file;
			$imglink = "/sjlp/images/SJSL-" . $number . " - " . $title .".jpg";
			echo "<li class=\"item\"><a href=\"" . $link . "\">
					<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
					<p>" . $cat . "<br /> 
					<a href=\"" . $link . "\">" . $title . "</a></p></li>";
		} 	
		else { 
			$year = substr($file, 0, 2);
			$part = substr($file, 3, 1);
			$number = substr($file, 5, 1);
			$title = substr($file, 7, -4);
			$link = "/sjlp/" . $dir . "/" . $file;
			$imglink = "/sjlp/images/" . $preimg . "-Part" . $part . " - " . $year . "-" . $part . "-" . $number . ".jpg";
			
			echo "<li class=\"item\"><a href=\"" . $link . "\">
					<img src=\"" . $imglink . "\" width=85 height=120 alt=\"" . $title . "\" /></a>
					<p>" . $cat . "<br />
					Part " . $part . " Number " . $number . "<br /> 
					20" . $year . "<br />
					<a href=\"" . $link . "\">" . $title . "</a></p></li>";
		}
		
		
		
	}
	
	echo "</ul>";
	?>	
		
		
		
	<!--	<h3>Resources</h3>
		<?php
		echo "<a href=\"TeacherResources/" . $cat . " - " . $disptitle . "-QR.pdf\">" . $cat . " - " . $disptitle . " QR Codes - (PDF, A4 Pages, 3x5 per page)</a>";
		?>
	-->
		
		
<?php 
include('footer.php'); 
?>

