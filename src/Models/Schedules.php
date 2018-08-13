<?php

namespace CloudLinkADI\TextMagic\Models;


class Schedules extends BaseModel
{
    protected $resourceName = 'schedules';

    protected $allowMethods = array('getList', 'get', 'delete');

}
