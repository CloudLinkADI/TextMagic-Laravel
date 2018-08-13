<?php
 
namespace CloudLinkADI\TextMagic\Models;
 

class CustomFields extends BaseModel
{
    protected $resourceName = 'customfields';

    protected $allowMethods = array('getList', 'create', 'get', 'update', 'delete', 'updateContact');

    /**
     * @param $id
     * @param array $params
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function updateContact($id, $params = array()) {
        $this->checkPermissions('updateContact');
        
        return $this->client->updateData($this->resourceName . '/' . $id . '/update', $params);
    }
    
}
