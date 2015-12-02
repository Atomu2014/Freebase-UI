<?php
$conn = mysqli_connect("localhost", "root", "Kevin2015", "freebase") or die("connection failed");
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

	$res = mysqli_query($conn, "SELECT Entity_URI id, name FROM Entity WHERE name LIKE '$ename' LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);	
} elseif ($query_type == 2){
	$eid = $_POST['eid'];
	$res = mysqli_query($conn, "SELECT Entity_ID id FROM Entity WHERE Entity_URI = '$eid'");
	$eid = mysqli_fetch_array($res)['id'];

	$res = mysqli_query($conn, "SELECT map.URI id FROM EntityType et JOIN idMap map ON (et.Type_ID = map.ID) WHERE et.Entity_ID = $eid LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
} elseif ($query_type == 3){
	$eid = $_POST['eid'];
	$res = mysqli_query($conn, "SELECT Entity_ID id FROM Entity WHERE Entity_URI = '$eid'");
	$eid = mysqli_fetch_array($res)['id'];

	$res = mysqli_query($conn, "SELECT map.URI id FROM EntityType et, Property p JOIN idMap map ON (p.Property_ID = map.ID) WHERE et.Entity_ID = $eid AND (et.Type_ID = p.domain OR et.Type_ID = p.range) LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
} elseif ($query_type == 4){
	$eid = $_POST['eid'];
	$res = mysqli_query($conn, "SELECT Entity_ID id FROM Entity WHERE Entity_URI = '$eid'");
	$eid = mysqli_fetch_array($res)['id'];

	$res = mysqli_query($conn, "SELECT map1.URI s, map2.URI o FROM FFF_Statement s JOIN idMap map1 ON (s.sID = map1.ID) JOIN idMap map2 ON (s.oID = map2.ID) WHERE (s.sID = $eid OR s.oID = $eid) LIMIT $limit1, $limit2");
	$list = array();
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}
	if ($limit1 + count($list) < $limit2){
		$limit = $limit2 - $limit1 - count($list);
		$res = mysqli_query($conn, "SELECT map.URI s, s.oValue o FROM FFN_Statement s JOIN idMap map ON (s.sID = map.ID) WHERE s.sID = $eid LIMIT 0, $limit");
		while ($row = mysqli_fetch_array($res2)){
			$list[] = $row;
		}
	}
	if ($limit1 + count($list) < $limit2){
		$limit = $limit2 - $limit1 - count($list);
		$res = mysqli_query($conn, "SELECT map1.URI s, map2.URI o FROM FNF_Statement s JOIN idMap map1 ON (s.sID = map1.ID) JOIN idMap map2 ON (s.oID = map2.ID) WHERE (s.sID = $eid OR s.oID = $eid) LIMIT 0, $limit");
		while ($row = mysqli_fetch_array($res2)){
			$list[] = $row;
		}
	} 
	if ($limit1 + count($list) < $limit2){
		$limit = $limit2 - $limit1 - count($list);
		$res = mysqli_query($conn, "SELECT map.URI s, s.oValue o FROM FNN_Statement s JOIN idMap map ON (s.sID = map.ID) WHERE s.sID = $eid LIMIT 0, $limit");
		while ($row = mysqli_fetch_array($res2)){
			$list[] = $row;
		}
	}

	echo json_encode($list);
} elseif ($query_type == 5){
	$tid = $_POST['tid'];
	$res = mysqli_query($conn, "SELECT Type_ID id FROM Type WHERE Type_URI = '$tid'");
	$tid = mysqli_fetch_array($res)['id'];

	$res = mysqli_query($conn, "SELECT map.URI id FROM EntityType et JOIN idMap map ON (et.Entity_ID = map.ID) WHERE et.Type_ID = $tid LIMIT $limit1, $limit2");
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
} elseif ($query_type == 6){
	$tid = $_POST['tid'];
	$res = mysqli_query($conn, "SELECT Type_Domain domain FROM Type WHERE Type_URI = '$tid'");
	$domain = mysqli_fetch_array($res)['domain'];

	$res = mysqli_query($conn, "SELECT map.URI id FROM Type t JOIN idMap map ON (t.Type_ID = map.ID) WHERE t.Type_Domain = $domain LIMIT $limit1, $limit2");
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
} elseif ($query_type == 7){
	$pid = $_POST['pid'];
	$res = mysqli_query($conn, "SELECT Property_ID id FROM Property WHERE Property_URI = '$pid'");
	$pid = mysqli_fetch_array($res)['id'];

	$res = mysqli_query($conn, "SELECT map1.URI s, map2.URI o FROM FFF_Statement s JOIN idMap map1 ON (s.sID = map1.ID) JOIN idMap map2 ON (s.oID = map2.ID) WHERE s.pID = LIMIT $limit1, $limit2");
	while ($row = mysqli_fetch_array($res)){
		$list[] = $row;
	}

	echo json_encode($list);
}
