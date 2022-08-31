<?php 
if(!empty($_GET['Barcode'])){
	/**
	* if the form isn't empty then do this
	*/
	$analytics_url = 'https://api-na.hosted.exlibrisgroup.com/almaws/v1/analytics/reports?path=%2Fshared%2FWashington%20Research%20Library%20Consortium%20(WRLC)%20Network%2FReports%2FCannedReports%2FRetention%20Reassignment%20Form%20-%20Barcode%20Lookup&limit=25&col_names=true&apikey=[insert your own API key]&filter=%3Csawx%3Aexpr+xsi%3Atype%3D%22sawx%3Acomparison%22+op%3D%22equal%22+xmlns%3Asaw%3D%22com.siebel.analytics.web%2Freport%2Fv1.1%22+xmlns%3Asawx%3D%22com.siebel.analytics.web%2Fexpression%2Fv1.1%22+xmlns%3Axsi%3D%22http%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema-instance%22+xmlns%3Axsd%3D%22http%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%22+%3E%3Csawx%3Aexpr+xsi%3Atype%3D%22sawx%3AsqlExpression%22%3E%22Physical%20Item%20Details%22.%22Barcode%22%3C%2Fsawx%3Aexpr%3E%3Csawx%3Aexpr+xsi%3Atype%3D%22xsd%3Astring%22%3E' . urlencode($_GET['Barcode']) . '%3C%2Fsawx%3Aexpr%3E%3C%2Fsawx%3Aexpr%3E';

	$analytics_xml = file_get_contents($analytics_url);
	$networkid = substr($analytics_xml, 1412, 16);

	$networkid_url = 'https://api-na.hosted.exlibrisgroup.com/almaws/v1/analytics/reports?path=%2Fshared%2FWashington%20Research%20Library%20Consortium%20(WRLC)%20Network%2FReports%2FCannedReports%2FRetention%20Reassignment%20Form&limit=25&col_names=true&apikey=[insert your own API key]&filter=%3Csawx%3Aexpr+xsi%3Atype%3D%22sawx%3Acomparison%22+op%3D%22equal%22+xmlns%3Asaw%3D%22com.siebel.analytics.web%2Freport%2Fv1.1%22+xmlns%3Asawx%3D%22com.siebel.analytics.web%2Fexpression%2Fv1.1%22+xmlns%3Axsi%3D%22http%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema-instance%22+xmlns%3Axsd%3D%22http%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%22+%3E%3Csawx%3Aexpr+xsi%3Atype%3D%22sawx%3AsqlExpression%22%3E%22Bibliographic+Details%22.%22Network+Id%22%3C%2Fsawx%3Aexpr%3E%3Csawx%3Aexpr+xsi%3Atype%3D%22xsd%3Astring%22%3E' . $networkid . '%3C%2Fsawx%3Aexpr%3E%3C%2Fsawx%3Aexpr%3E';
	
	$networkid_xml = simplexml_load_file($networkid_url) or die("Network ID not found. This local title may not yet be merged to a network zone record.");

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
			<h2 class="card-title">Retention Reassignment Tool</h2>
		  </div>
		  <div class="card-body">
		    <p><h3 style="font-size: 1em">Insert barcode below of Lost/Missing/Damaged item to display all other copies of the title in the network</h3></p>
	<form action="">
		<input type="text" name="Barcode" placeholder="insert barcode here"/>
		<button type="submit">Submit</button>
		<br/>

	</form>
		<p>Title -- <span style="font-weight:bold">Barcode</span> -- Process Type (Lost, Missing, etc) -- <span style="color:red">RETENTION STATUS</span></p>
		<br>
			<?php
				foreach ($networkid_xml->QueryResult->ResultXml->rowset->Row as $item ) {printf('<li>%s -- <span style="font-weight:bold">%s</span> -- %s -- <span style="color:red">%s</span></li>', $item->Column2, $item->Column4, $item->Column6, $item->Column5);}
			?>
		</div></div></div></div>
</body>
</html>
