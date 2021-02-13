<?php
	ob_start();
	session_start();
	$_SESSION['cursession'] = $_REQUEST['college_session'];
	include_once("../../../connect.php");
	$gdcol="gdcol1";
	$doc="document1";

if ($_REQUEST['college_id'] == 2) {
	$gdcol = "gdcol2";
	$doc = "document2";
} else if ($_REQUEST['college_id'] == 3) {
	$gdcol = "gdcol3";
	$doc = "document3";
} else if ($_REQUEST['college_id'] == 4) {
	$gdcol = "gdcol4";
	$doc = "document4";
} else if ($_REQUEST['college_id'] == 5) {
	$gdcol = "gdcol5";
	$doc = "document5";
}

	$RESPONSE = array();
	$RESPONSE['result'] = 'success';
	$RESPONSE['document'] = array();
	$documentdata = array();

	$sql="select * from gdcollegeerp.$doc where s_id='$_REQUEST[s_id]' and status not in ('Not Applicable', 'Permanently N/A') ";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result) > 0 ) {
		if($d = mysqli_fetch_row($result)) {
			do {
				$documentdata['document_name'] = $d[1];
				$documentdata['file_path'] = $d[3];
				$documentdata['file_type'] = $d[4];
				$documentdata['file_status'] = $d[6];

				array_push($RESPONSE['document'], $documentdata);
			} while($d = mysqli_fetch_array($result));
		}
	}

	echo json_encode($RESPONSE);
?>