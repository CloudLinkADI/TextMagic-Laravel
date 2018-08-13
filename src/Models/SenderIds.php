<?php
 
namespace CloudLinkADI\TextMagic\Models;

 
class SenderIds extends BaseModel
{
    protected $resourceName = 'senderids';

    protected $allowMethods = array('getList', 'create', 'get', 'delete');

}
