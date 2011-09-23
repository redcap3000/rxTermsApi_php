<?php
if(!class_exists('APIBaseClass')) {	require('APIBaseClass.php');}
class rxTermsApi extends APIBaseClass{
// would like to some day implement this in SOAP...

   public static $api_url = 'http://rxnav.nlm.nih.gov/REST/RxTerms';

   public function __construct($url=NULL,$outputType=NULL)
        {
	            if($outputType == NULL) $this->output_type = 'xml';
	            else $this->output_type='json';
	         
                parent::new_request(($url?$url:self::$api_url));
	}
        public function setOutputType($type){
                if($type != $this->output_type)
                        $this->output_type = ($type != 'xml'?'json':'xml');
        }
        public function setRxcui($rxcui){
                $this->rxcui = $rxcui;
        }

        public function _request($path,$method,$data=NULL){
                if ($this->output_type == 'json')
                        return parent::_request($path,$method,$data,"Accept:application/json");
                else
                        return parent::_request($path,$method,$data,"Accept:application/xml");
        }

        public function getRxcui($rxcui=NULL){
                if($rxcui != NULL) return $rxcui;
                elseif($this->rxcui) return $this->rxcui;
        }
        
        public function getAllRxTermInfo($rxcui=NULL){
        	if($rxcui!= NULL)
               return self::_request("/rxcui/$rxcui/allinfo",'GET');
            elseif($this->rxcui)
            	return self::_request("/rxcui/".$this->rxcui."/allinfo",'GET');
        }
        
        public function getRxTermDisplayName($rxcui=NULL){
        	if($rxcui!= NULL)
               return self::_request("/rxcui/$rxcui/name",'GET');
            elseif($this->rxcui)
            	return self::_request("/rxcui/".$this->rxcui."/name",'GET');
        }
        
        public function getRxTermsVersion(){
               return self::_request("/version",'GET');
        }

}



