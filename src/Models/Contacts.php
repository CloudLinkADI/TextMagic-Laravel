<?php

namespace CloudLinkADI\TextMagic\Models;

class Contacts extends BaseModel
{

    protected $resourceName = 'contacts';

    protected $allowMethods = array('getList', 'create', 'get', 'update', 'delete', 'search', 'getLists');

    /**
     * @param $id
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function getLists($id) {
        $this->checkPermissions('getLists');
        
        return $this->client->retrieveData($this->resourceName . '/' . $id . '/lists');
    }
    
}
