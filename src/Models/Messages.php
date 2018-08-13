<?php

namespace CloudLinkADI\TextMagic\Models;

class Messages extends BaseModel
{
    protected $resourceName = 'messages';

    protected $allowMethods = array('getList', 'create', 'get', 'delete', 'search', 'getPrice');

    /**
     * @param $params
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function getPrice($params) {
        $this->checkPermissions('getPrice');
        
        return $this->client->retrieveData($this->resourceName . '/price', $params);
    }


}
