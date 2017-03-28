<?php

$items = simpleXMLElement($xml);
echo $items->item[0]->title;

?>
