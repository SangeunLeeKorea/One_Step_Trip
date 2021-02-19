<?
	$keyword = $_GET["keyword"];
	
	$db_host = "localhost";
	$db_user = "onesteptrip";
	$db_password = "onestepdb#1";
	$db_name = "onesteptrip";
	
	$conn = mysqli_connect( $db_host, $db_user, $db_password, $db_name );
	
	$continent_json = "";
	$country_json = "";
	if ( mysqli_connect_errno( $conn ) ) {
		echo "데이터베이스 연결 실패: " . mysqli_connect_error();
	} else {
		// continent 관련 정보
		$query1 = "SELECT * FROM continents WHERE name_kor LIKE '%".$keyword."%'";
		
		$result = mysqli_query( $conn, $query1 );	
		$data_json = array();
		while( $row = mysqli_fetch_assoc( $result ) ){
			array_push( $data_json, $row );
		}
		$continent_json = json_encode( $data_json );
		
		// country 관련 정보
		$query2 = "SELECT * FROM country WHERE name_kor LIKE '%".$keyword."%'";
		
		$result = mysqli_query( $conn, $query2 );
		$data_json2 = array();
		while( $row = mysqli_fetch_assoc( $result ) ){
			array_push( $data_json2, $row );
		}
		$country_json = json_encode( $data_json2 );
	}
	
	include "../search_result.php";
	//echo $html;
?>