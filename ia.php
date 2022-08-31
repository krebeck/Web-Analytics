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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <title>Interactive Analytics</title>
  <link rel="stylesheet" href="../Materialize/materialize.min.css"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
  <nav>
        <div class="nav-wrapper blue"> 
		<img src="../Materialize/wrlc-logo-white.png" height="50px" style="margin:5px 0 0 20px; position:absolute;"> 
		<a href="#" class="brand-logo" style="margin-left:90px;">Web Analytics: Network and SCF reports... without Alma!</a>
        </div>
	<div class="position-absolute mx-auto help-button" style="top:2px;">
            <a class="btn btn-info" href="home.html">HOME</a>
        </div>
  </nav>
    <div class="jumbotron">
      <div class="container task-AdminAddInstitution">
        <div class="container mt-4 position-relative">
        </div>
        <div class="card">
		  <div class="card-header">
			<h2 class="card-title">Journal Volume Overlap Tool</h2>
		  </div>
		  <div class="card-body">
		    <p><h3 style="font-size: 1em">Insert ISSN of title for accession to display all volumes of that title already in the SCF</h3></p>
			<form action="">
				<input type="text" name="ISSN" placeholder="1234-5678"/>
				<button type="submit">Submit</button>
			<br/>
			</form>
			<p>ISSN -- Title -- Barcode -- Tray Location -- <span style="font-weight:bold">Volume</span></p>
			<?php
			foreach ($analytics_xml->QueryResult->ResultXml->rowset->Row as $item ) {printf('<li>%s -- %s -- %s -- %s -- <span style="font-weight:bold">%s</span></li>', $item->Column1, $item->Column2, $item->Column4, $item->Column7, $item->Column6);}
			?>
	</div></div></div></div>
</body>
</html>
