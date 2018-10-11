<?php
namespace X\Service\Youtube;
class YoutubeProject {
    /** @var string */
    protected $key = null;
    /** @var string */
    protected $proxy = null;
    /** @var int */
    protected $proxyPort = 1080;
    /** @var int */
    protected $proxyType = CURLPROXY_HTTP;
    /** @var string */
    protected $apiServer = 'https://www.googleapis.com';
    /** @var integer */
    protected $apiServerPort = 443;
    
    /**
     * @param unknown $option
     */
    public function __construct( $option ) {
        foreach ( $option as $key => $value ) {
            $this->$key = $value;
        }
    }
    
    /**
     * @return string
     */
    public function getApiKey() {
        return $this->key;
    }
    
    /**
     * @param unknown $name
     * @param array $params
     * @throws \Exception
     * @return mixed
     */
    public function call( $name, $params=array() ) {
        $params['key'] = $this->getApiKey();
        $params = http_build_query($params);
        $url = $this->apiServer.'/youtube/v3/'.$name.'?'.$params;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PORT, $this->apiServerPort);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        if ( null !== $this->proxy ) {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
            curl_setopt($ch, CURLOPT_PROXYPORT, $this->proxyPort);
            curl_setopt($ch, CURLOPT_PROXYTYPE, $this->proxyType);
        }
        
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('Curl Error : ' . curl_error($ch));
        }
        curl_close($ch);
        
        $response = json_decode($response, true);
        return $response;
    }
}