


<?php

require 'vendor/autoload.php';
$query=$_REQUEST['query'];
$catagory=$_REQUEST['catagory'];
use Elasticsearch\ClientBuilder;
function searchStandard($query,$catagory)
{
	$client = ClientBuilder::create()->build();
    $params['body'] = [
        'query' => [
            'bool' => [
                'should' => [
                    ['match' => [
                        'title' => $query
                    ]],
                    ['match' => [
                        'text' => $query
                    ]],
                ]                        
            ] 
        ]
    ];

    $results = $client->search($params);
	echo"<style>ul {
  
  list-style-type: none;
  width: fill;
  margin-left:0vmax;
  margin-top:0vmax;
  
}
div{
	background-color: aqua;
	width: 100vmax;

}
 
h3 {
  font: bold 20px/1.5 Helvetica, Verdana, sans-serif;
  /*float: left;
*/}
 
li img {
	margin-top:0vmin;
	margin-bottom:0vmin;
  float: right;
  height:20vmin;
  width:15vmax

}
 
li p {
	margin-left:0.6vmax;
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
text2{
width:60vmax;
height:40vmin;
overflow:hidden;
background:yellow;
}



	</style>";
$count= count($results["hits"]["hits"]);

	echo"<ul>";
		
	for ($x = 0; $x <= 9; $x++) {
		if ($results["hits"]["hits"][$x]["_source"]["topic"]== $catagory){
			$map='http://localhost/images/';
			$id=$results["hits"]["hits"][$x]["_id"];
			$image="$map{$id}.png";
			echo "<li class='text'><img class='image'src=$image> <p>" .$results["hits"]["hits"][$x]["_source"]["title"]."<br/>" .$results["hits"]["hits"][$x]["_source"]["text"]. "</p></li>" ;
		
	}
	}
	echo"</ul>";

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
	<div class='top'><form action='someQueries.php' method='GET'>     <input type='text' name='query' />
    <input type='submit' value='Search' class='search'/> <button class='search2'>advance search</button></form></div>
	<div class='mid' >
		<div class='floating' id='1'><h1>Topics</h1>
		<ul>
		
		
		</ul></div>
		<div class='float2' id='2'>
";
searchStandard($query,$catagory);



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