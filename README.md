# Web-Analytics
This code uses the Analytics API to retrieve reports from Alma's Oracle Analytics Server and - in many cases - will pass user-supplied filters and prompts to refine the information. 

The Alma Analytics API can be used to retrieve a report.  That process is explained in the knowledge base here:
https://developers.exlibrisgroup.com/blog/how-to-use-an-api-to-retrieve-an-alma-analytics-report/

The same API can be used to add filters to that report.  That process is explained in the knowledge base here:
https://developers.exlibrisgroup.com/blog/how-to-use-an-api-to-send-filters-and-retrieve-an-alma-analytics-report-in-5-easy-steps/

Beginning with the two exercises above, we can extend things a bit further with some PHP code to allow users to provide a prompt like a barcode or an ISSN (as in our example "ia.php") and then inject that value into the filter and print the XML results in a slighly more attractive way.

The code supplied here defaults to outputting the raw xml as shown here:
```
<?php
	print_r($analytics_xml);
?>
```
An example of more structured and targeted output of specific columns is also provided.  However, if you'd like to use that, you must comment out the above and uncomment the below.
```
<?php
//**foreach ($analytics_xml->QueryResult->ResultXml->rowset->Row as $item ) {printf('<li>%s -- %s -- %s -- %s -- <span style="font-weight:bold">%s</span></li>', $item->Column1, $item->Column2, $item->Column4, $item->Column7, $item->Column6);}/*
?>
```
This code can be extended in numerous ways.  Multiple filters can be passed, multiple prompts can be provided, and numerous subqueries can be staged based on input. For example, a barcode prompt can be used to look up an OCLC# which can then be trimmed from the first results and injected into a second query in the background.  These additional subqueries would just need to be created as reports in Oracle Analytics Server.
