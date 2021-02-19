function set_list( continent ){
	$.post(
		"http://onesteptrip.dothome.co.kr/script/showAllFunction.php",
		{ continent: continent },
		function( data ){
			var json = JSON.parse( data );
			
			var html = "";
			for( let i = 0; i < json.length; i++ ){
				html = html + "<tr class='list_row' onclick='moveto(\"" + json[i]["name"] + "\");'><td><span class='list_text'>" + json[i]["name_kor"] + "</span></td></tr>";;
			}
			
			document.getElementById( "country_table" ).innerHTML = html;
		}
	);
}

function moveto( country ){
	location.href = "http://onesteptrip.dothome.co.kr/countries/country_" + country + ".html";
}