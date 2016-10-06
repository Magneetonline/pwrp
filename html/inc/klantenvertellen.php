<?php	
	
	add_action( 'init', function() {
	    // expertinfo
	    add_rewrite_rule( 'reviews/([0-9]+)/?$', 'index.php?pagename=reviews&page=$matches[1]', 'top' );
	    add_rewrite_tag( '%magneet_reviews_id%', '([^&]+)' );
	});


	function get_reviews(){
		$transientname = "klantenvertellen_data";
		$transient = get_transient($transientname);
		
		if( ! empty( $transient ) ) {
    		$klantenvertellenData = $transient;
		} else {
			$klantenvertellenData = get_data();
	    	set_transient( $transientname, $klantenvertellenData, WEEK_IN_SECONDS );
		}
		
		return $klantenvertellenData;
	}
	
	function get_data(){
		$url = "https://www.klantenvertellen.nl/xml/comfort_bouwer/";
		//return file_get_contents(__DIR__.'/test.xml');
		
		$ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_REFERER, $_SERVER['SERVER_NAME'] );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        $response = curl_exec( $ch );
        curl_close( $ch );
        return $response;
	}
	
	function klantenvertellen_cijfer($html=false, $amount=0){
		$data = simplexml_load_string(get_reviews());
		if($amount <= 0){
			if($html == true){
				$new = str_replace(",", "<span>,", $data->statistieken->gemiddelde)."</span>";
			}else{
				$new = $data->statistieken->gemiddelde;
			}
		}else{
			if($html == true){
				$new = str_replace(",", "<span>,", $amount)."</span>";
			}else{
				$new = $data->statistieken->gemiddelde;
			}
		}
		return($new);
	}
	
	function klantenvertellen_total(){
		$data = simplexml_load_string(get_reviews());
		return($data->statistieken->aantalbeoordelingen);
	}
	
	function klantenvertellen_aanbeveling(){
		$data = simplexml_load_string(get_reviews());
		return($data->statistieken->percentageaanbeveling);
	}
	
	function klantenvertellen_gemiddelden(){
		$data = simplexml_load_string(get_reviews());
		$all = array();
		foreach($data->statistieken->gemiddelden->cijfer as $cijfer){
			array_push($all, array('type' => $cijfer['name'], 'amount' => "$cijfer"));
		}
		die(var_dump($all));
	}
	
	function klantenvertellen_stars($wow=0){
		if($wow == 0){
			$aamount = (float)str_replace(",", ".", klantenvertellen_cijfer());
		}else{
			$aamount = (float)str_replace(",", ".", $wow);
		}
		$amount = floor($aamount * 2 / 2) / 2;
		for(;;){
			if ($amount <= 0) {
		        break;
		    }
			$amount = $amount - 1;
			$html .= "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
		}
		$new = 5 - floor($aamount * 2 / 2) / 2;
		for(;;){
			if ($new <= 0) {
		        break;
		    }
			$new = $new - 1;
			$html .= "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
		}
		return $html;
	}
	
	function get_detail_reviews(){
		$data = simplexml_load_string(get_reviews());
		return $data->resultaten->resultaat;
	}
	
	function get_content_by_attr($array, $key){
		foreach($array as $item){
			if((string)$item['name'] == $key){
				return (string)$item;
			}
		}
		return false;
	}
	
	get_detail_reviews();
	
	function magneet_reviews_func( $atts ){
		include(IRON_PARENT_DIR.'/templates/review.php');
	}
	add_shortcode( 'magneet_reviews', 'magneet_reviews_func' );
	
	function get_pagination($total, $limit, $cur){
		$pages 		= ceil( $total / $limit );
		$start      = ( ( $cur - $total ) > 0 ) ? $cur - $total : 1;
		$end        = ( ( $cur + $total ) < $pages ) ? $cur + $total : $pages;
		
		$html       = '<ul class="review--pagination">';
		if($cur >= 2){
			$html       .= '<li class="review--pagination__prev"><a href="'.get_the_permalink().'' . ( $cur - 1 ) . '/">&laquo;</a></li>';
		}
		
		for ( $i = $start ; $i <= $end; $i++ ) {
	        $class  = ( $cur == $i ) ? "review--pagination__active" : "review--pagination__item";
	        $html   .= '<li class="' . $class . '"><a href="'.get_the_permalink().'' . $i . '/">' . $i . '</a></li>';
	    }
		
		if($cur < $pages){
			$html       .= '<li class="review--pagination__next"><a href="'.get_the_permalink().'' . ( $cur + 1 ) . '/">&raquo;</a></li>';
		}
		$html       .= '</ul>';
		
		return "$html";
	}
	
	
	?>