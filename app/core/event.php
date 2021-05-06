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

$json = array();

	//SQL QUERY
	$sql = "SELECT 	".PREFIX."tprojects.IdProject AS id,
				".PREFIX."tprojects.IdClient AS client,
				".PREFIX."tprojects.ProjectStatus AS description,
				".PREFIX."tprojects.ProjectStart AS start,
				".PREFIX."tprojects.ProjectDeadline AS end,
				".PREFIX."phase.PhaseId,
				".PREFIX."phase.PhaseColor,
				".PREFIX."phase.PhaseName,
				".PREFIX."twotype.TypeTitle AS title
			FROM 
				".PREFIX."tprojects
				LEFT JOIN ".PREFIX."twotype ON ".PREFIX."tprojects.TypeId = ".PREFIX."twotype.TypeId
				LEFT JOIN ".PREFIX."phase ON ".PREFIX."tprojects.ProjectStatus = ".PREFIX."phase.PhaseId
			WHERE
				".PREFIX."tprojects.isArchived = '0'
			ORDER BY 
				IdProject";
    $get = mysqli_query($mysqli, $sql) or die('Error, retrieving Calendar Data failed. ' . $mysqli->error);

//JSON
while ($row = mysqli_fetch_array($get, MYSQLI_ASSOC)) {
	$render['id'] = $row['id'];
	$render['client'] = $row['client'];
	$render['title'] = $row['title'];
	$render['start'] = $row['start'];
	$render['end'] = $row['end'];
	$render['description'] = $row['PhaseName'];
	$render['label'] = $row['PhaseColor'];
	array_push($json,$render);
}

echo json_encode($json);

mysqli_close($mysqli);
