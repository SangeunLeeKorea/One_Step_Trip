<?
	$db_host = "localhost";
	$db_user = "onesteptrip";
	$db_password = "onestepdb#1";
	$db_name = "onesteptrip";
	
	$conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
	
	if (mysqli_connect_errno($conn)) {
		echo "데이터베이스 연결 실패: " . mysqli_connect_error();
	} else {
		$continent = $_POST[ "continent" ];
		$query = "SELECT ID FROM continents WHERE name='".$continent."'";
		$result = mysqli_query( $conn, $query );
		
		$continent_ID = 0;
		if( $result === false ){
			echo mysqli_error( $conn );
			return;
		} else $continent_ID = mysqli_fetch_array( $result )[0];
		
		$query = "SELECT * FROM country WHERE continent_ID=".$continent_ID;
		$result = mysqli_query( $conn, $query );
		if( $result === false ){
			echo mysqli_error( $conn );
			return;
		} else {
			$data_json = array();
			while( $row = mysqli_fetch_assoc( $result ) ){
				array_push( $data_json, $row );
			}
			$json = json_encode( $data_json );
			echo $json;
		}
	}
?>