<?php 
if(!empty($_GET['ISSN'])){
	/**
	* if the form isn't empty then do this
	*/
	$ISSN = $_GET['ISSN']
	
	$analytics_url = 'https://api-na.hosted.exlibrisgroup.com/almaws/v1/analytics/reports?path=[insert urlencoded path to your own report like %2Fshared%2FYour%20Report]&limit=25&col_names=true&apikey=[insert your own API key]&filter=[this is your urlencoded filter as constructed according to the Ex Libris directions linked in the instructions]' .$ISSN. '[the remainder of the filter after the prompted portion from the form]';

	$analytics_xml = simplexml_load_file($analytics_url) or die("ERROR: ISSN not found.");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-0"/>
  <title>Interactive Analytics</title>
</head>
<body>
<h1>Journal Volume Overlap Tool</h1>
<h3>Insert ISSN of title for accession to display all volumes of that title already in the SCF</h3>
<form action="">
	<input type="text" name="ISSN"/>
	<button type="submit">Submit</button>
<br/>
<pre>
<?php
	print_r($analytics_xml);
?>
</pre>
</form>
<p>ISSN -- Title -- Barcode -- Tray Location -- <span style="font-weight:bold">Volume</span></p>	
<?php
//**foreach ($analytics_xml->QueryResult->ResultXml->rowset->Row as $item ) {printf('<li>%s -- %s -- %s -- %s -- <span style="font-weight:bold">%s</span></li>', $item->Column1, $item->Column2, $item->Column4, $item->Column7, $item->Column6);}/*
?>
</body>
</html>
