<?php

namespace CloudLinkADI\TextMagic\Models;
 
class Lists extends BaseModel
{
    protected $resourceName = 'lists';

    protected $allowMethods = array('getList', 'create', 'get', 'update', 'delete', 'search', 'getContacts', 'updateContacts', 'deleteContacts');

    /**
     * @param $id
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function getContacts($id) {
        $this->checkPermissions('getContacts');
        
        return $this->client->retrieveData($this->resourceName . '/' . $id . '/contacts');
    }

    /**
     * @param $id
     * @param array $params
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function updateContacts($id, $params = array()) {
        $this->checkPermissions('updateContacts');
        
        return $this->client->updateData($this->resourceName . '/' . $id . '/contacts', $params);
    }

    /**
     * @param $id
     * @param array $params
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function deleteContacts($id, $params = array()) {
        $this->checkPermissions('deleteContacts');
        
        return $this->client->deleteData($this->resourceName . '/' . $id . '/contacts', $params);
    }
}
