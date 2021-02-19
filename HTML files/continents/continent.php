<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="http://onesteptrip.dothome.co.kr/css/continent.css">
		<link rel="stylesheet" type="text/css" href="http://onesteptrip.dothome.co.kr/css/titlebar.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		
		<script src="http://onesteptrip.dothome.co.kr/script/jquery-3.5.1.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		<script type="text/javascript" src="http://onesteptrip.dothome.co.kr/script/continent.js"></script>
		<script type="text/javascript" src="http://onesteptrip.dothome.co.kr/script/search.js"></script>
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
		<div id="main_content">
			<div id="content">
				<div id="continent">
					<canvas id="continent-canvas" width="720" height="720"></canvas>
					<script>
						// canvas를 그리는데 필요한 변수들
						const pin_src = "http://onesteptrip.dothome.co.kr/img/continent/pin1.png";
						const pin_selected_src = "http://onesteptrip.dothome.co.kr/img/continent/pin2.png";
						const pin_selected_sub_src = "http://onesteptrip.dothome.co.kr/img/continent/pin3.png";
						const pin_color = "#00C8FD";
						const pin_width = 40;
						const pin_height = 40;
						const img_src = "http://onesteptrip.dothome.co.kr/img/continent/";
						
						const country_path = "http://onesteptrip.dothome.co.kr/countries/country_";
						const continent_name = "<?= $continent_eng ?>";
						
						$( "#continent-canvas" ).css( "background-image", 'url( "http://onesteptrip.dothome.co.kr/img/continent/' + continent_name + '.png" )' );
						
						// pin_position: 나라 목록을 담고 있는 배열
						// [ 나라 이름( 한글 ), x좌표, y좌표, 나라 이름( 영어이자 ID ), 간단 설명 title, 간단 설명 내용 ]
						var pin_position = <?= $json ?>;
						
						// 실제 캔버스에 값이 그려지는 부분
						var canvas = document.getElementById( "continent-canvas" );
						var context = canvas.getContext( "2d" );
						
						/* pin 세팅 */
						var pin = new Image();
						pin.src = pin_src;
						pin.onload = function(){
							for( var i = 0; i < pin_position.length; i++ ){
								context.drawImage( pin, pin_position[i]["xpos"], pin_position[i]["ypos"], pin_width, pin_height );
							}
						}
						
						/* pin click 효과 */
						canvas.addEventListener( "click", function( e ) {
							for( var i = 0; i < pin_position.length; i++ ){
								var maxX = translate_pos( pin_position[i]["xpos"] + 20, 1, canvas );
								var minX = translate_pos( pin_position[i]["xpos"], 1, canvas );
								
								var maxY = translate_pos( pin_position[i]["ypos"] + 20, 2, canvas );
								var minY = translate_pos( pin_position[i]["ypos"], 2, canvas );
								
								if( minX <= e.clientX && e.clientX <= maxX ){
									if( minY <= e.clientY && e.clientY <= maxY ){
										location.href = "http://onesteptrip.dothome.co.kr/countries/country_" + pin_position[i]["name"] + ".html";
										break;
									}
								}
							}
						});
						
						/* pin hover 효과 */
						// 선택되었을 경우의 핀
						var selected_pin = new Image();
						var sub_pin = new Image();
						selected_pin.src = pin_selected_src;
						sub_pin.src = pin_selected_sub_src;

						// 마우스 이벤트 적용
						canvas.addEventListener( "mousemove", function( e ) {
							retranslate( e.clientX, e.clientY, canvas );
							for( var i = 0; i < pin_position.length; i++ ){
								var maxX = translate_pos( parseInt( pin_position[i]["xpos"] ) + 40, 1, canvas );
								var minX = translate_pos( parseInt( pin_position[i]["xpos"] ), 1, canvas );
								
								var maxY = translate_pos( parseInt( pin_position[i]["ypos"] ) + 40, 2, canvas );
								var minY = translate_pos( parseInt( pin_position[i]["ypos"] ), 2, canvas );
								
								if( minX <= e.clientX && e.clientX <= maxX ){
									if( minY <= e.clientY && e.clientY <= maxY ){
										// 마우스 포인터를 선택 가능 모양으로 변경
										canvas.style.cursor = "pointer";
										// 핀 모양을 바꿔서 현재 선택된 핀을 표시함
										context.clearRect( pin_position[i]["xpos"], pin_position[i]["ypos"], pin_width, pin_height );
										context.drawImage( selected_pin, pin_position[i]["xpos"], pin_position[i]["ypos"], pin_width, pin_height );
										context.drawImage( sub_pin, pin_position[i]["xpos"], pin_position[i]["ypos"], pin_width, pin_height );
									
										break;
									} else {
										// hover 되지 않은 핀일 경우, 원래 모양으로 바꿈
										context.clearRect( pin_position[i]["xpos"], pin_position[i]["ypos"], pin_width, pin_height );
										context.drawImage( pin, pin_position[i]["xpos"], pin_position[i]["ypos"], pin_width, pin_height );
										// 마우스 포인터를 다시 기본으로 변경
										canvas.style.cursor = "default";
									}
								} else {
									// 위 else에서와 동일
									context.clearRect( pin_position[i]["xpos"], pin_position[i]["ypos"], pin_width, pin_height );
									context.drawImage( pin, pin_position[i]["xpos"], pin_position[i]["ypos"], pin_width, pin_height );
									canvas.style.cursor = "default";
								}
							}
						});
					</script>
				</div>
				<div id="country-list">
					<p class="country-title"> <span class="continent-name"> <?= $continent_kor ?> </span> (으)로 떠나볼까요? </p>
					<ol class="country-ol" id="country_list"></ol>
				</div>
				<script>
					var html = "";
					for( var i = 0; i < pin_position.length; i++ ){
						html = html + 
						"<li><a class='country' href='" + country_path + pin_position[i]["name"] + ".html" + "' id='" + pin_position[i]["name"] + "'>" + pin_position[i]["name_kor"] + "</a></li>";
					}
					document.getElementById( "country_list" ).innerHTML = html;
				</script>
			</div>
		</div>
	</body>
</html>