<?php namespace core;

include "_comestoarra_labs_.php";
define('PREFIX','cbn_');

//DB CONNECTION
$mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME) or die("Error " . mysqli_error($link)); 

if (mysqli_connect_errno()) {
	printf("mysqli connection failed: ", mysqli_connect_error());
	exit();
}

// Change character set to utf8
if (!$mysqli->set_charset('utf8')) {
    printf('Error loading character set utf8: %s\n', $mysqli->error);
}

//X Axis
$category = array();
$category['name'] = 'Status';
// Keterangan Kategori 1
$series1 = array();
$series1['name'] = 'Project';
// Keterangan Kategori 2
$series2 = array();
$series2['name'] = 'Completed';
// Keterangan Kategori 3
$series3 = array();
$series3['name'] = 'In Progress';

    $query = "SELECT
				COUNT(".PREFIX."tprojects.IdProject) AS data1,
							".PREFIX."tprojects.ProjectStatus, 
							".PREFIX."phase.PhaseId,  
							".PREFIX."phase.PhaseName AS status   
						FROM 
							".PREFIX."tprojects 
							LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
						GROUP BY 
							".PREFIX."tprojects.ProjectStatus DESC";
    $res = mysqli_query($mysqli, $query) or die('Error, retrieving Graph Data failed. ' . $mysqli->error);

while($r = mysqli_fetch_array($res)) 
{
	$category['data'][] = $r['status'];
	$series1['data'][] = $r['data1']; 
}


$result = array();
array_push($result,$category);
array_push($result,$series1);

print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($mysqli);