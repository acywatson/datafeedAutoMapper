<?php
//TO DO
//1) Handle variants - need to ask allie about this
//DONE 2) Add more preview data (3-5 items worth - table?)
//3) Create way to pull xml in from merchant URL
//4) (REACH) add fuzzy search that tries to auto-select the correct value :-)
//DONE 5) Pull out JS into separate file and include.
//DONE 6)Add show/hide for mini-preview below selects
//7)Gracefully handle arrays that show up in XML (see notices on Blendtec load);
//8)UI for adding datafeed fields.
//9)Ability to skip a certain number of rows

//pull in XML file - this where we do it if including from local file.
////include 'sample_xml.php';
//pull in current list of accepted AL fields
include 'datafeed_fields.php';

//pull in XML file from remote URL.
$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
//$url = "http://www.blendtec.com/products/google_shopping.xml";
//$url = "https://www.acadima.com/GoogleShopping_full.xml";
$url = $_POST["url"];
$xml = file_get_contents($url, false, $context);
$xml = simplexml_load_string($xml);

//stuff XML into variable

//use below line when loading from URL
$items = $xml;

//Use below line to load from file (vs. URL);
//$items = new SimpleXMLElement($xml);

//declare placeholder
$testKeys;

//Use the SimpleXML children() function to handle namespaces.

//google likes to use both the atom and google namespaces, so we
//need to loop through twice, once with each namespace, then build
//a big array to hold it all.

//atom namespace
$ns_atom = $items->channel->item;
$xmlKeys = get_object_vars($ns_atom);

//google namespace
$ns_google = $items->channel->item->children('http://base.google.com/ns/1.0');
$gKeys = get_object_vars($ns_google);


//add google namespace keys to array
foreach($gKeys as $key => $value){
  $xmlKeys[$key] = $value;
}

/* Build Array of Preview Data */

$previewData = [];

foreach($items->channel->item as $item){

  $g = $item->children('http://base.google.com/ns/1.0');
  $a = $item->children();
  $tempArrayA = get_object_vars($a);
  $tempArrayG = get_object_vars($g);

  foreach($tempArrayG as $key => $value){
    $tempArrayA[$key] = $value;
  }

  array_push($previewData, $tempArrayA);

}

//var_dump($previewData);

/* End Build Preview Data */

echo "<h1>Datafeed AutoMapper</h1>";

echo "<form id='buildString' method='post'>";
//iterate through array of xml keys
  foreach ($xmlKeys as $key => $value) {
    //filter out arrays - may need a better solution eventually
    if(gettype($value) != "array"){

    echo "<label>".$key."</label> >  ";

    echo "<select id='$key' class='fields'>";
    echo "<option value=''>Unmapped</option>";
      foreach ($fields as $field){
        echo "<option value='$field'>";
        echo $field;
        echo "</option>";
      }

    echo "</select>";

    echo "  <label>Show Data Preview</label>";
    echo "<input type='checkbox' class='miniPreview' id='showPreview-".$key."'/>";

    //output some of that data in a preview div for quick reference
    echo "<div style=' display:none; border: 1px solid black; margin-top: 5px; max-width: 50%;' id='preview-".$key."'><h5>Data Preview</h5>$value</div>";

    echo "<br><br>";
  } //array check
  };

?>

</form> <!-- buildString form -->

<button id="submitBuildString">PRINT</button>

<textarea rows=10 cols=50 id="output"></textarea>

<!-- Display preview data in table -->

<h3>Data Preview</h3>

<table id="previewData" border = "1" style="margin-top: 20px; border:1px solid black;">

<?php

  echo "<thead>";

  foreach ($previewData[0] as $key => $value) {
    echo "<th>";
    echo $key;
    echo "</th>";

  }

  echo "</thead>";

  echo "<tbody>";

  foreach ($previewData as $data) {

      echo "<tr>";

    foreach($data as $column => $value){
      //filter out arrays -  we can handle these here by just looping again
      //...kicker is the parsing up top.
      echo "<td>";
      if(gettype($value) != "array"){
      echo $value;
    }else{
      echo "Array (Invalid Data Type)";
    }
      echo "</td>";

    }

    echo "</tr>";

    }

  echo "</tbody>";

?>

</table>

<script type="text/javascript" async="async" src="script.js"></script>
