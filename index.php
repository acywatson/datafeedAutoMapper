<?php

//Silence!

?>
<h1>Datafeed AutoMapper</h1>
<form id="submitXmlUrlForm" method="POST" action="parser.php">

<input type='text' id='xmlUrl' name='xmlUrl'/>

<button type="submit" id="submitXmlUrl">Fetch</button>
</form>

<div id="parserResult"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

///////////////////////////////////
/* insert data into html element */
///////////////////////////////////

function insertData(data){

  $('#parserResult').html(data);

}

////////////////////////////////////////////
/* send url to the parser and return html */
///////////////////////////////////////////

function getFeed(xmlUrl){

  $.post(
    'parser.php',
    {url : xmlUrl},
    function(data){insertData(data)},
    'html'
  );

}

////////////////////////////////////////////
/* handle form submission */
///////////////////////////////////////////

$("#submitXmlUrlForm").on("submit", function(event){

  event.preventDefault();
  var xmlUrl = $("#xmlUrl").val();
  getFeed(xmlUrl);

});

</script>
