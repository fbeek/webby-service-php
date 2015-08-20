<?php
	if (!isset($_REQUEST["ticker"]) || empty($_REQUEST["ticker"])) { 
		throw new RuntimeException ("keine ID Angegeben!");
	}
	$ticker = (int) $_REQUEST["ticker"];
	if (($handle = fopen("/var/www/webby_standalone/radio_list.csv", "r")) !== FALSE) {
    		while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
			if($data[1] == $ticker){
				break;
			}
			else{
				$data = null;
			}	
        	}
    	}
    	fclose($handle);
	
	if ( !$data )
	{
		throw new RuntimeException("Sender wurde nicht gefunden");
	}

	//Generate XML Response
	header ("Content-Type:text/xml");  
	$doc = new DOMDocument('1.0', 'UTF-8');
	$root = $doc->createElement('radio');
	$root = $doc->appendChild($root);
	
	$idRadio = $doc->createElement('idRadio','RADIO_CUORE-MP3-32');
	$idRadio = $root->appendChild($idRadio);
	
	$name = $doc->createElement('name',$data[0]);
	$name = $root->appendChild($name);
	
	$url = $doc->createElement('url',$data[6]);
	$url = $root->appendChild($url);
	
	$codec = $doc->createElement('codec',$data[7]);
	$codec = $root->appendChild($codec);
	
	$bitrate = $doc->createElement('bitrate');
	$bitrate = $root->appendChild($bitrate);
	
	echo $doc->saveXML(); 
?>