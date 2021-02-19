<html>
	<head>
		<link rel="stylesheet" type="text/css" href="http://onesteptrip.dothome.co.kr/css/titlebar.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="http://onesteptrip.dothome.co.kr/css/showAll.css">
		
		<script src="http://onesteptrip.dothome.co.kr/script/jquery-3.5.1.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		<script type="text/javascript" src="http://onesteptrip.dothome.co.kr/script/search.js"></script>
		<script type="text/javascript" src="http://onesteptrip.dothome.co.kr/script/allcontent.js"></script>
	</head>
	<body>
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
			<input type="text" id="country_search_input" onkeypress="javascript:if( event.keyCode == 13 ) { search( this.value); }">
			<a href="#" id="country_search_button"> 
				<img src="http://onesteptrip.dothome.co.kr/icon/search.png" id="country_search_button_img" onclick="search(document.getElementById('country_search_input').value);">
			</a>
		</div>
		<div id="over_div">
			<p id="over_title"> 한 눈에 보기 </p>
			<p id="over_content"> 모든 대륙과 나라들을 한 눈에 볼 수 있습니다. <br> 원하는 나라를 손쉽게 찾아보세요. </p>
		</div>
		<div id="main_div">
			<div id="inner_div">
				<div id="continent_list">
					<table class="list_table" id="continent_table"></table>
				</div>
				<div id="country_list">
					<table class="list_table" id="country_table"></table>
				</div>
				<script>
					// 대륙 리스트 채우기
					var html = "<tr class='list_row' onclick='set_list(\"ALL\");'><td><span class='list_text'> 전체 </span></td></tr>";
					var continent_list = <?= $continent_json ?>;
					
					for( let i = 0; i < continent_list.length; i++ ){
						html = html + "<tr class='list_row' onclick='set_list(\"" + continent_list[i]["name"] + "\");'><td><span class='list_text'>" + continent_list[i]["name_kor"] + "</span></td></tr>";
					}
					
					document.getElementById( "continent_table" ).innerHTML = html;
					
					// 나라 리스트 채우기
					var country_html = "";
					var country_list = <?= $country_json ?>;
					
					for( let i = 0; i < country_list.length; i++ ){
						country_html = country_html + "<tr class='list_row' onclick='moveto(\"" + country_list[i]["name"] + "\");'><td><span class='list_text'>" + country_list[i]["name_kor"] + "</span></td></tr>";
					}
					
					document.getElementById( "country_table" ).innerHTML = country_html;
				</script>
			</div>
		</div>
	</body>
</html>