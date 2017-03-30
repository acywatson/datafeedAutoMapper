<?php
//TO DO
//1) Add option to map secondary file (variants)
//DONE 2) Add more preview data (3-5 items worth - table?)
//DONE 3) Create way to pull xml in from merchant URL
//4) (REACH) add fuzzy search that tries to auto-select the correct value :-)
//DONE 5) Pull out JS into separate file and include.
//DONE 6)Add show/hide for mini-preview below selects
//DONE (Sort of) 7)Gracefully handle arrays that show up in XML (see notices on Blendtec load);
//8)UI for adding datafeed fields.
//DONE 9)Ability to skip a certain number of rows
//DONE 10)Fix spacing in preview table - output blank if record is missing column.
//11) Add view that compares common XSLTs and XML side-by-side
//12) XML Lint integration
//13) Integrate manual php XSLT tester file

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
//Here we're checking to see which "item" has the most children,
//then using that to build our preview table header row.

//set some global variables
$index = 0;
$highest_index = 0;
$highest_count = 0;

//loop through the array
foreach ($items->channel->item as $item) {
//handle both namespaces
  $g_count = $item->children('http://base.google.com/ns/1.0')->count();
  $n_count = $item->children()->count();
  $count = $g_count; + $n_count;

//set globals
  if($count > $highest_count){
    $highest_count = $count;
    $highest_index = $index;
  }
//iterate counter
  $index++;
}

$ns_google = $items->channel->item[$highest_index]->children('http://base.google.com/ns/1.0');
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

echo "<form id='buildString' method='post'>";
//iterate through array of xml keys
  foreach ($xmlKeys as $key => $value) {
    //filter out arrays - may need a better solution eventually

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

    if(gettype($value) != "array"){
      echo "<div style=' display:none; border: 1px solid black; margin-top: 5px; max-width: 50%;' id='preview-".$key."'><h5>Data Preview</h5>$value</div>";
    }else{
      $previewString = "";
      foreach($value as $aKey => $aVal){
        $previewString .= $aVal.", ";
      }
      echo "<div style=' display:none; border: 1px solid black; margin-top: 5px; max-width: 50%;' id='preview-".$key."'><h5>Data Preview</h5>$previewString</div>";

    } //array check

    echo "<br><br>";

  };

?>

</form> <!-- buildString form -->

<button id="submitBuildString">PRINT MAP</button>

<textarea rows=10 cols=50 id="output"></textarea>

<!-- Display preview data in table -->

<h3>Data Preview</h3>

<button id ="showAllRows">Show All Rows</button>

<table id="previewData" border = "1" style="margin-top: 20px; border:1px solid black; width: 100%; overflow-x: scroll; overflow-y: scroll;">

<?php

  echo "<thead>";
  echo "<th></th>";

  foreach ($xmlKeys as $key => $value) {
    echo "<th>";
    echo $key;
    echo "</th>";

  }

  echo "</thead>";

  echo "<tbody>";

  $rowCount = 0;

  foreach ($previewData as $data) {

      echo "<tr id='pRow-".$rowCount."'>";
      echo "<td><input type='checkbox' id='hideRow-".$rowCount."''>";
      echo "<label>Hide Row</label>";
      echo "</td>";

      foreach($xmlKeys as $xmlK => $xmlV){

      echo "<td>";
      //handle empty nodes - insert placeholder for table alignment.
      if(!array_key_exists($xmlK, $data)){
        echo "no data";
      }else{
      //handle arrays -  we can handle these here by just looping again
      if(gettype($data[$xmlK]) != "array"){
      echo $data[$xmlK];
      }else{
      $previewString = "";
      foreach ($data[$xmlK] as $aKey => $aVal) {
        $previewString .= $aVal.", ";
      }
      echo $previewString;
      }///arrayCheck else

    } //column data check
        echo "</td>";

  } //xmlKeys iterator


  //  }

    echo "</tr>";
    $rowCount++;
  }

  echo "</tbody>";

?>

</table>

<script type="text/javascript" async="async" src="script.js"></script>
