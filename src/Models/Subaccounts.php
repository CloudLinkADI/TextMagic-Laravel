<?php

namespace CloudLinkADI\TextMagic\Models;

 
class Subaccounts extends BaseModel
{

    protected $resourceName = 'subaccounts';

    protected $allowMethods = array('getList', 'create', 'get', 'delete');

}
