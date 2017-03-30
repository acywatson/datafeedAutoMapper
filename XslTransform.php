<?php
// require_once('utils/XmlToParamArray.php');

// Load the XML source
$xml = new DOMDocument;
$xml->load('bidgunner.xml');

$xsl = new DOMDocument;
$xsl->load('bidgunner-custom.xsl');

// Configure the transformer
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // attach the xsl rules

$sFinal = $proc->transformToXML($xml);
echo $sFinal;

/*
$proc->transformToURI($xml, 'C:/Transformed_Results.txt');
echo "Done!\n";
*/

/*
$oXmlParse = new XmlToParamArray();
$oXmlParse->bParseArray($sFinal, 'Job');
print_r($oXmlParse->arrGetParams());
*/
?> 
