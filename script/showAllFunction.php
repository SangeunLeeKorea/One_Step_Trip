<?
	$db_host = "localhost";
	$db_user = "onesteptrip";
	$db_password = "onestepdb#1";
	$db_name = "onesteptrip";
	
	$conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
	
	$continent_name = $_POST["continent"];
	
	$country_json = "";
	
	if (mysqli_connect_errno($conn)) {
		echo "데이터베이스 연결 실패: " . mysqli_connect_error();
	} else {
		if( $continent_name === "ALL" ){
			$query = "SELECT * FROM country";
			$result = mysqli_query( $conn, $query );
			$country_array = array();
			while( $row = mysqli_fetch_assoc( $result ) ){
				array_push( $country_array, $row );
			}
			$country_json = json_encode( $country_array );
		} else {
			$query = "SELECT * FROM continents WHERE name='".$continent_name."'";
			$result = mysqli_query( $conn, $query );
			$continent_ID = mysqli_fetch_assoc( $result )["ID"];
			
			$query = "SELECT * FROM country WHERE continent_ID=".$continent_ID;
			$result = mysqli_query( $conn, $query );
			$country_array = array();
			while( $row = mysqli_fetch_assoc( $result ) ){
				array_push( $country_array, $row );
			}
			$country_json = json_encode( $country_array );
		}
		print $country_json;
	}
?>