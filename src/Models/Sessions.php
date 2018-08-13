<?php

namespace CloudLinkADI\TextMagic\Models;


class Sessions extends BaseModel
{
    protected $resourceName = 'sessions';
    
    protected $allowMethods = array('getList', 'get', 'delete', 'getMessages');

    /**
     * @param $id
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function getMessages($id) {
        $this->checkPermissions('getMessages');
        
        return $this->client->retrieveData($this->resourceName . '/' . $id . '/messages');
    }
    
}
