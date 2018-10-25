


<?php

require 'vendor/autoload.php';
$query=$_REQUEST['query'];
$titel=$_REQUEST['titel'];
use Elasticsearch\ClientBuilder;

function searchAlmostAdvanced($qTitle, $qText) {
	$client = ClientBuilder::create()->build();
	$params['body'] = ['query' => ['bool' => []]];
	$should = [];


	if (isset($qTitle) || isset($qText)) {
	  $should['match'] = [];

	  if (isset($qTitle)) {
	    $should['match']['title'] = $qTitle;
	  };
	  if (isset($qText)) {
	    $should['match']['text'] = $qText;
	  };
	};

	$params['body']['query']['bool']['should'] = $should;

    $results = $client->search($params);


    $results = $client->search($params);
	echo"<style>ul {

  list-style-type: none;
  width: fill;
  margin-left:0vmax;
  margin-top:0vmax;

}

h3 {
  font: bold 20px/1.5 Helvetica, Verdana, sans-serif;
  /*float: left;
*/}

li img {
	margin-top:2vmin;
	margin-bottom:0vmin;
  float: left;
  height:20vmin;

}

li p {
	/*float:left;*/
  font: 200 1vmax/1.5 Georgia, Times New Roman, serif;
}

li {
	height:20vmin;
	margin-left:-1.7vmax;
	overflow:hidden;

}

li:hover {
  background: #eee;
  cursor: pointer;
}

	</style>";
$count= count($results["hits"]["hits"]);
if ($count> 1){
	echo"<ul>";

	for ($x = 0; $x <= 9; $x++) {
		echo "<li class='text'>" .$results["hits"]["hits"][$x]["_source"]["text"]. "</li>" ;
	}
	echo"</ul>";
}
else{
echo "<h1>No results<h1>";
}

}










echo"
<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Untitled Document</title>
<link href='website.css' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class='top'><form action='advancedQuery.php' method='GET'>     <input type='text' name='query' />
	<input type='text' name='titel' />
    <input type='submit' value='Search' class='search'/> <button class='search2'>advance search</button></form></div>
	<div class='mid' >
		<div class='floating' id='1'><h1>Topics</h1>
		<ul>
		<li class='cato'>word</li>

		</ul></div>
		<div class='float2' id='2'>
";
searchAlmostAdvanced($query,$titel);



echo"





		</div>

	</div>
	<div class='bot'>

	</div>
</body>
</html>



";


// standard query





// aggregation for the faceted search
?>
