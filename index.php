<?php
/*
PHP - Highlighter Text 
Date: 2015-07-23
By: Engineer, Web Developer Gregory Hidalgo Ramírez
Websites:
- www.gregoryhidalgo.com
- www.valoresweb.com
GitHub:  @ghidalgor | Twitter: @websoundcr
Please refer me :-);
*/

include("includes/function.php");
$originTxt = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

$keySearch = "";
if(isset($_POST['txtHighlighter'])){
	$keySearch = $_POST['txtHighlighter'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>PHP - Highlighter Text</title>
	<link rel="stylesheet" type="text/css" href="http://www.gregoryhidalgo.com/app/vendors/css/reset/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/css_highlighter.css">
</head>
<body>
	<div class="txtHeader">
		<h1>PHP - <span class="text_highlighter">Highlight</span> Text</h1>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<section class="txtArea">
		<h2>Type and <span class="text_highlighter">highlight</span> text.</h1>
		<hr>
		<form id="frm1" name="frm1" enctype="multipart/form-data" method="POST" action="index.php">
			<p>
				<label>Keyword</label>
				<input id="txtHighlighter" name="txtHighlighter" maxlength="50" size="50" value="<?php echo $keySearch;?>" placeholder="Type here your Highlight Text"> Example: lorem, LoRem, IPSUM, etc...
			</p>
			<p>
				<input type="submit" value=" Highlight Text">
			</p>
		</form>
		<div class="clear"></div>
	</section>

	<section class="txtArea">
		<h2>Original Text</h1>
		<hr>
		<p>
			<?php echo $originTxt; ?>
		</p>
		<div class="clear"></div>
	</section>

	<section class="txtArea">
		<h2>Highlighter Text</h1>
		<hr>
		<p>
			<?php text_highlighter($originTxt, $keySearch); ?>
		</p>
		<div class="clear"></div>
	</section>

	<footer class="txtFooter">
		<h3>PHP <span class="text_highlighter">highlight</span> Text</h3>
		<h4>By  <a href="http://www.gregoryhidalgo.com/" target="_blank"> <?php echo date('Y'); ?> Gregory Hidalgo</a> - Degree in Computer Science</h4>
	</footer>
</body>
</html>