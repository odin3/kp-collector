<?php
include('config.php');
include('lib/phpQuery.php');

function query($path) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, KP_ROOT.$path); // set url to post to 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Fake user-agent for GitHub
	curl_setopt($ch, CURLOPT_USERAGENT, H_USER_AGENT);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'csrftoken='.H_TOKEN
	));
	$out = curl_exec($ch);
	curl_close($ch);

	return $out;
}

function search($q) {
	$response = query("/search/films/?text={$q}");
	$doc = phpQuery::newDocument($response);
	$list = $doc['.film-list__list > .film-list-chunk > .film-snippet'];

	var_dump($list);
}

echo search('/search/films/?text=11');
?>