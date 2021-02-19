<?
	$db_host = "localhost";
	$db_user = "onesteptrip";
	$db_password = "onestepdb#1";
	$db_name = "onesteptrip";
	
	$conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
	
	if (mysqli_connect_errno($conn)) {
		echo "데이터베이스 연결 실패: " . mysqli_connect_error();
	} else {
		$query = "SELECT * FROM continents";
		$result = mysqli_query( $conn, $query );
		if( $result === false ) echo mysqli_error( $conn );
		else echo mysqli_fetch_array( $result )[2];
	}
?>