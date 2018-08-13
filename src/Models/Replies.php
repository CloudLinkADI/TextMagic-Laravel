<?php
 
namespace CloudLinkADI\TextMagic\Models;


class Replies extends BaseModel
{
    protected $resourceName = 'replies';

    protected $allowMethods = array('getList', 'get', 'delete', 'search');

}
