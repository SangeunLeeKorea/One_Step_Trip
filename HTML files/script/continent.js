function translate_pos( pos, direction, canvas ){	// direction :: 1( horizontal ) 2( vertical )
	var canvas_rect = canvas.getBoundingClientRect();
	var canvas_width = Math.round( canvas_rect.width );
	var canvas_height = Math.round( canvas_rect.height );
	
	var position = 0;
	switch( direction ){
	case 1 :
		position = canvas_rect.left + ( parseInt( pos ) / 720 ) * canvas_width;
		break;
	case 2 :  
		position = canvas_rect.top + ( parseInt( pos ) / 720 ) * canvas_height;
		break;
	default :
		position = 0;
		break;
	}
	return Math.round( position );
}
						
function retranslate( xpos, ypos, canvas ){
	var canvas_rect = canvas.getBoundingClientRect();
	var canvas_width = canvas_rect.width;
	var canvas_height = canvas_rect.height;
	
	var x = ( xpos - canvas_rect.left ) / canvas_width * 720;
	var y = ( ypos - canvas_rect.top ) / canvas_height * 720;
	
	console.log( Math.round( x ) + " " + Math.round( y ) );
}

