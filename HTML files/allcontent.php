<?
	$db_host = "localhost";
	$db_user = "onesteptrip";
	$db_password = "onestepdb#1";
	$db_name = "onesteptrip";
	
	$conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
	
	$continent_json = "";
	$counry_json = "";
	
	if (mysqli_connect_errno($conn)) {
		echo "데이터베이스 연결 실패: " . mysqli_connect_error();
	} else {
		$query = "SELECT * FROM continents";
		$result = mysqli_query( $conn, $query );
		if( $result === false ) echo mysqli_error( $conn );
		else{
			$continent_array = array();
			while( $row = mysqli_fetch_assoc( $result ) ){
				array_push( $continent_array, $row );
			}
			$continent_json = json_encode( $continent_array );
		}
		
		$query = "SELECT * FROM country";
		$result = mysqli_query( $conn, $query );
		if( $result === false ) echo mysqli_error( $conn );
		else{
			$county_array = array();
			while( $row = mysqli_fetch_assoc( $result ) ){
				array_push( $county_array, $row );
			}
			$country_json = json_encode( $county_array );
		}
	}
	
	include "showAll.php";
?>