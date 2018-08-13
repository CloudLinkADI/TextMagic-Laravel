<?php

namespace CloudLinkADI\TextMagic\Models;


class Numbers extends BaseModel
{

    protected $resourceName = 'numbers';

    protected $allowMethods = array('getList', 'getAvailable', 'create', 'get', 'delete');

    /**
     * @param array $params
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function getAvailable($params = array()) {
        $this->checkPermissions('getAvailable');
        
        return $this->client->retrieveData($this->resourceName . '/available', $params);
    }
    
}
