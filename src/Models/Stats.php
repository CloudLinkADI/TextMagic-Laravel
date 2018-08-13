<?php

namespace CloudLinkADI\TextMagic\Models;

 
class Stats extends BaseModel
{

    protected $resourceName = 'stats';

    protected $allowMethods = array('spending', 'messaging');

    /**
     * @param array $params
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function spending($params = array()) {
        $this->checkPermissions('spending');
        
        return $this->client->retrieveData($this->resourceName . '/spending', $params);
    }

    /**
     * @param array $params
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function messaging($params = array()) {
        $this->checkPermissions('messaging');
        
        return $this->client->retrieveData($this->resourceName . '/messaging', $params);
    }
    
}
