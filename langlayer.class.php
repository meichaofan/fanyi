<?php
/*
languageLayer class - Detect language
version 1.0 12/29/2015

API reference at https://languagelayer.com/documentation

Copyright (c) 2015, Wagon Trader

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
class languageLayer{
    
    //*********************************************************
    // Settings
    //*********************************************************
    
    //Your screenshotLayer API key
    //Available at https://languagelayer.com/product
    private $apiKey = 'YOUR_API_KEY_HERE';
    
    //API endpoint
    //only needs to change if the API changes location
    private $endPoint = 'http://apilayer.net/api/detect';
    
    //API key/value pair params
    public $params = array();
    
    //holds the error code, if any
    public $errorCode;
    
    //holds the error text, if any
    public $errorText;
    
    //response object
    public $response;
    
    //JSON response from API
    public $responseAPI;
    
    /*
    method:  getResponse
    usage:   getResponse(string text);
    params:  text = the text to determine the langauge from
    
    This method will build the reqeust and get the response from the API
    The supplied text will be url encoded
    
    returns: null
    */
    public function getResponse($text){
        
        if( is_array($text) ){
            
            foreach( $text as $batch ){
                
                $batch = urlencode($batch);
                
                $this->setParam('query[]',$batch);
                
            }
            
        }else{
            
            $text = urlencode($text);
            
            $this->setParam('query',$text);
            
        }
        
        $request = $this->buildRequest();
        
        $this->responseAPI = file_get_contents($request);
        
        $this->response = json_decode($this->responseAPI);
        
        if( !empty($this->response->error->code) ){
            
            $this->errorCode = $this->response->error->code;
            $this->errorText = $this->response->error->info;
            
        }
        
    }
    
    /*
    method:  buildRequest
    usage:   buildRequest(void)
    params:  none
    
    This method will build the api request url.
    
    returns: api request url
    */
    public function buildRequest(){
        
        $request = $this->endPoint.'?access_key='.$this->apiKey;
        
        foreach( $this->params as $key=>$value ){
            
            $request .= '&'.$key.'='.$value;
            
        }
        
        return $request;
        
    }
    
    /*
    method:  setParam
    usage:   setParam(string key, string value);
    params:  key = key of the params key/value pair
             value =  value of the params key/value pair
    
    add or change the params key/value pair specified.
    
    returns: null
    */
    public function setParam($key,$value){
        
        $this->params[$key] = $value;
        
    }
    
}
?>
