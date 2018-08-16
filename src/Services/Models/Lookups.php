<?php

/**
 * This file is part of the TextmagicRestClient package.
 *
 * Copyright (c) 2018 CloudLink ADI. All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CloudLinkADI\TextMagic\Services\Models;

/**
 * @author Andrew Coghlan
 */

class Lookups extends \Textmagic\Services\Models\BaseModel {

    protected $resourceName = 'lookups';

    protected $allowMethods = array('getList', 'create', 'get', 'delete', 'search', 'lookup');

    public function lookup($number) {
        
        $this->checkPermissions('lookup');

        return $this->client->retrieveData($this->resourceName . '/' . $number, []);
    }

}
