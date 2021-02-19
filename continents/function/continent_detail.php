<?php
	$continent = $_GET["continent"];

	$db_host = "localhost";
	$db_user = "onesteptrip";
	$db_password = "onestepdb#1";
	$db_name = "onesteptrip";
	
	$conn = mysqli_connect( $db_host, $db_user, $db_password, $db_name );
	$json = "";
	
	$continent_kor = "";
	$continent_eng = "";
	$continent_ID = 0;
	
	if ( mysqli_connect_errno( $conn ) ) {
		echo "데이터베이스 연결 실패: " . mysqli_connect_error();
	} else {
		$query = "SELECT * FROM continents WHERE name='".$continent."'";		
		$result = mysqli_query( $conn, $query );		
		$result_array = mysqli_fetch_array( $result );
		
		if( $result === false ){
			echo mysqli_error( $conn );
			return;
		} else{
			$continent_ID = $result_array[0];
			$continent_eng = $result_array[1];
			$continent_kor = $result_array[3];
		}
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
		} 
	}
	
	$html = include "../continent.php";
	//echo $html; 
?>