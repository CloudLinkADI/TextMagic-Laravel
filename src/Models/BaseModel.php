<?php

namespace CloudLinkADI\TextMagic\Models;

use CloudLinkADI\TextMagic\TextMagic;

class BaseModel {

    /**
     * Http client instance
     * @var object
     */
    protected $client;
    
    /**
     * Resource name
     * @var string
     */
    protected $resourceName = null;
    
    /**
     * Item name for create and update methods
     * @var string
     */
    protected $itemName = null;

    /**
     * Allowed methods for model
     * @var array
     */
    protected $allowMethods = array('getList', 'create', 'get', 'update', 'delete', 'search');
    
    /**
     * Check model method name for allowed execution
     * @throws \ErrorException
     * @param string $operation Operation name
     */
    protected function checkPermissions($operation) {
        if (!in_array($operation, $this->allowMethods)) {
            throw new \ErrorException('Model is not supported this method.');
        }
    }
    
    /**
     * BaseModel constructor
     *
     * @param TextMagic $client Http client
     */
    public function __construct(TextMagic $client) {
        $this->client = $client;
    }
    
    /**
     * Retrive collection of model objects
     * @throws \ErrorException
     * @param array $params Query params
     * @return array
     */
    public function getList($params = array()) {
        $this->checkPermissions('getList');
        
        return $this->client->retrieveData($this->resourceName, $params);
    }

    /**
     * Create new model object
     * @throws \ErrorException
     * @param array $params Object parameters
     * @return boolean
     */
    public function create($params = array()) {
        $this->checkPermissions('create');
        
        return $this->client->createData($this->resourceName, $params);
    }
    
    /**
     * Retrieve model object
     * @throws \ErrorException
     * @param mixed $id Object id
     * @return array
     */
    public function get($id) {
        $this->checkPermissions('get');
        
        return $this->client->retrieveData($this->resourceName . '/' . $id);
    }
    
    /**
     * Update model object
     * @throws \ErrorException
     * @param mixed $id Object id
     * @param array $params Object parameters
     * @return array
     */
    public function update($id, $params = array()) {
        $this->checkPermissions('update');
        
        return $this->client->updateData($this->resourceName . '/' . $id, $params);
    }
    
    /**
     * Delete model object
     * @throws \ErrorException
     * @param mixed $id Object id
     * @return boolean
     */
    public function delete($id) {
        $this->checkPermissions('delete');
        
        return $this->client->deleteData($this->resourceName . '/' . $id);
    }
    
    /**
     * Search model object
     * @throws \ErrorException
     * @param array $params Query params
     * @return array
     */
    public function search($params = array()) {
        $this->checkPermissions('search');
        
        return $this->client->retrieveData($this->resourceName . '/search', $params);
    }



}
