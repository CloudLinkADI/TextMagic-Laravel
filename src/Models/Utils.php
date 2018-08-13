<?php

namespace CloudLinkADI\TextMagic\Models;

 
class Utils extends BaseModel
{
    protected $allowMethods = array('ping');

    /**
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function ping() {
        $this->checkPermissions('ping');

        return $this->client->retrieveData('ping');
    }
    
}
