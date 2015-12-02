<?php
$conn = mysqli_connect("172.16.2.62", "qyr", "qyr123456", "freebase") or die("connection failed");
mysqli_set_charset($conn, "utf8");

$query_type = $_POST['query_type'];
$limit1 = $_POST['limit1'];
$limit2 = $_POST['limit2'];

if ($limit1 >= $limit2 || $limit1 < 0){
	$limit1 = 0;
	$limit2 = 50;
}

if ($query_type == 1){
	$ename = '%'.$_POST['ename'].'%';

	$res = mysqli_query($conn, "SELECT Entity_ID id, name FROM Entity WHERE name LIKE '$ename' LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);	
} elseif ($query_type == 2){
	$eid = $_POST['eid'];

	$res = mysqli_query($conn, "SELECT Type_URI id FROM EntityType WHERE Entity_ID = '$eid' LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
	return;
} elseif ($query_type == 3){
	$eid = $_POST['eid'];

	$res = mysqli_query($conn, "SELECT Property.Property_URI FROM EntityType, Property WHERE EntityType.Entity_ID = '$eid' AND (EntityType.Type_URI = Property.domain OR EntityType.Type_URI = Property.range) LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
} elseif ($query_type == 4){
	$eid = $_POST['eid'];

	$res1 = mysqli_query($conn, "SELECT sURI s, oURI o FROM RelationStatement WHERE sURI = '$eid' OR oURI = '$eid' LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res1)){
		$list[] = $row;
	}
	if ($limit1 + count($list) < $limit2){
		$limit = $limit2 - $limit1 - count($list);
		$res2 = mysqli_query($conn, "SELECT sURI s, oValue o FROM ValueStatement WHERE sURI = '$eid' LIMIT 0, $limit");
		while ($row = mysqli_fetch_array($res2)){
			$list[] = $row;
		}
	}

	echo json_encode($list);
} elseif ($query_type == 5){
	$tid = $_POST['tid'];

	$res = mysqli_query($conn, "SELECT * FROM EntityType WHERE Type_URI = '$tid' LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
} elseif ($query_type == 6){
	$tid = $_POST['tid'];
	$domain = substr($tid, 0, strrpos($tid, '.')).'%';

	$res = mysqli_query($conn, "SELECT * FROM Type WHERE Type_URI LIKE '$domain' LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
} elseif ($query_type == 7){
	$pid = $_POST['pid'];

	$list = array();
	$res = mysqli_query($conn, "SELECT sURI s, oURI o FROM RelationStatement WHERE pURI = '$pid' LIMIT $limit1, $limit2");
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
}

