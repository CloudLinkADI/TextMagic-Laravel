<?php

namespace CloudLinkADI\TextMagic\Models;

class Unsubscribers extends BaseModel
{
    protected $resourceName = 'unsubscribers';

    protected $allowMethods = array('getList', 'create', 'get');

}
