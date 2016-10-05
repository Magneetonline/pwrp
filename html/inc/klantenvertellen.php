<?php	
	
	add_action( 'init', function() {
	    // expertinfo
	    add_rewrite_rule( 'reviews/([0-9]+)/?$', 'index.php?pagename=reviews&page=$matches[1]', 'top' );
	    add_rewrite_tag( '%magneet_reviews_id%', '([^&]+)' );
	});


	function get_reviews(){
		$transientname = "klantenvertellen_data";
		$transient = null;//get_transient($transientname);
		
		if( ! empty( $transient ) ) {
    		$klantenvertellenData = $transient;
		} else {
			$klantenvertellenData = get_data();
			//die(var_dump($klantenvertellenData));
	    	set_transient( $transientname, $klantenvertellenData, WEEK_IN_SECONDS );
		}
		
		return $klantenvertellenData;
	}
	
	function get_data(){
		$url = "https://www.klantenvertellen.nl/xml/uitgeester_notariaat/";
		$url = "https://www.klantenvertellen.nl/xml/comfort_bouwer/";
		
		$ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_REFERER, $_SERVER['SERVER_NAME'] );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        $response = curl_exec( $ch );
        curl_close( $ch );
        return $response;
	}
	
	function klantenvertellen_cijfer($html=false){
		$data = simplexml_load_string(get_reviews());
		if($html == true){
			$new = str_replace(",", "<span>,", $data->statistieken->gemiddelde)."</span>";
		}else{
			$new = $data->statistieken->gemiddelde;
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
	
	function klantenvertellen_stars(){
		$aamount = (float)str_replace(",", ".", klantenvertellen_cijfer());
		$amount = floor($aamount * 2 / 2) / 2 ;
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