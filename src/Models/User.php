<?php

namespace CloudLinkADI\TextMagic\Models;

 
class User extends BaseModel
{
    protected $resourceName = 'user';

    protected $allowMethods = array('get', 'update');

    /**
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function get($id = null) {
        $this->checkPermissions('get');
        
        return $this->client->retrieveData($this->resourceName);
    }

    /**
     * @param array $params
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function update($params = array(),$additional = null) {
        $this->checkPermissions('update');
        
        return $this->client->updateData($this->resourceName, $params);
    }
    
}
