<html>
	<head>
		<script src="http://onesteptrip.dothome.co.kr/script/jquery-3.5.1.js"></script>
		<script src="http://onesteptrip.dothome.co.kr/script/search.js"></script>
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="http://onesteptrip.dothome.co.kr/css/titlebar.css">
		<link rel="stylesheet" type="text/css" href="http://onesteptrip.dothome.co.kr/css/search_result.css">
	</head>
	<body>
		<!-- navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark" id="navbar">
		  <a class="navbar-brand title-logo" id="title" href="http://onesteptrip.dothome.co.kr">
			<img src="http://onesteptrip.dothome.co.kr/icon/logo.png" width="96" height="30" alt="" loading="lazy"> 
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
			  <a class="nav-link menu" href="http://onesteptrip.dothome.co.kr"> Home </a>
			  <a class="nav-link menu" href="http://onesteptrip.dothome.co.kr/introduction.html"> Introduce </a>
			  <a class="nav-link menu" href="http://onesteptrip.dothome.co.kr/allcontent.php"> Continents </a>
			</div>
		  </div>
		</nav>	
		
		<div id="country_search">
			<input type="text" id="country_search_input" autofocus onkeypress="javascript:if( event.keyCode == 13 ) { search( this.value ); }">
			<a href="#" id="country_search_button"> 
				<img src="http://onesteptrip.dothome.co.kr/icon/search.png" id="country_search_button_img" onclick="search(document.getElementById('country_search_input').value);">
			</a>
		</div>	

		<div style="width: 80%; margin: auto;">			
			<div class="result_page_title">
				<p> "<?= $keyword ?>"의 검색 결과 </p>
				<hr>
			</div>
			<!-- continent result -->
			<div class="show_search_result">
				<p class="result_title"> 대륙 </p>
				<ol class="result_list" id="continent_result_list"></ol>
			</div>
			<script>
				var html = "";
				var continent_result = <?= $continent_json ?>;
				for( let i = 0; i < continent_result.length; i++ ){
					html = html + "<li class='result_content' onclick='goto_continent(\"" + continent_result[i]["name"] + "\");'>" + continent_result[i]["name_kor"] + "</li>";
				}
				if( continent_result.length === 0 ) html = "<li class='no_result'> 검색 결과가 없습니다. </li>";
				
				document.getElementById( "continent_result_list" ).innerHTML = html;
			</script>
			
			<!-- country result -->
			<div class="show_search_result">
				<p class="result_title"> 나라 </p>
				<ol class="result_list" id="country_result_list"></ol>
			</div>
			<script>
				var html = "";
				var country_result = <?= $country_json ?>;
				for( let i = 0; i < country_result.length; i++ ){
					html = html + "<li class='result_content' onclick='goto_country(\"" + country_result[i]["name"] + "\");'>" + country_result[i]["name_kor"] + "</li>";
				}
				if( country_result.length === 0 ) html = "<li class='no_result'> 검색 결과가 없습니다. </li>";
				
				document.getElementById( "country_result_list" ).innerHTML = html;
			</script>
		</div>
	</body>
</html>