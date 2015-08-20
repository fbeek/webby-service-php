<?php
	$server_adresse = 'http://webby.example.de/';
	exec('tar cfvz /var/www/webby_standalone/download/radio_list.tar.gz -C /var/www/webby_standalone/ radio_list.csv');
	
	//Generate XML Response
	header ("Content-Type:text/xml");  
	$doc = new DOMDocument('1.0', 'UTF-8');
	$root = $doc->createElement('radioList');
	$root = $doc->appendChild($root);
	
	$time = time();
	$lastBuildDate = $doc->createElement('lastBuildDate',date('Y-m-d',$time).'T'.date('H:i:s',$time));
	$lastBuildDate = $root->appendChild($lastBuildDate);
	
	$date_validity = $doc->createElement('date_validity',0);
	$date_validity = $root->appendChild($date_validity);
	
	$time = time();
	$estimated_update_time = $doc->createElement('estimated_update_time',date('H:i:s',$time));
	$estimated_update_time = $root->appendChild($estimated_update_time);
	
	$catalog_radio = $doc->createElement('catalog_radio');
		$url_catalog_radio = $doc->createElement('url_catalog_radio',$server_adresse.'download/radio_list.tar.gz');
		$url_catalog_radio = $catalog_radio->appendChild($url_catalog_radio);
		$md5_catalog_radio = $doc->createElement('md5_catalog_radio',md5_file('/var/www/webby_standalone/download/radio_list.tar.gz'));
		$md5_catalog_radio = $catalog_radio->appendChild($md5_catalog_radio);
	$catalog_radio = $root->appendChild($catalog_radio);
	
	$list_category = $doc->createElement('list_category');
		/*$category = $doc->createElement('category');
			$label = $doc->createElement('label','Top Radio');
			$label = $category->appendChild($label);
			$dbColumn = $doc->createElement('dbColumn','Group');
			$dbColumn = $category->appendChild($dbColumn);
			$filter = $doc->createElement('filter','TopRadio');
			$filter = $category->appendChild($filter);
		$category = $list_category->appendChild($category);
		*/
		$category = $doc->createElement('category');
			$label = $doc->createElement('label','Deutsche Radiosender');
			$label = $category->appendChild($label);
			$dbColumn = $doc->createElement('dbColumn','Continent');
			$dbColumn = $category->appendChild($dbColumn);
			$filter = $doc->createElement('filter','All');
			$filter = $category->appendChild($filter);
		$category = $list_category->appendChild($category);
	$list_category = $root->appendChild($list_category);
	
	echo $doc->saveXML(); 
?>