<?php

namespace CloudLinkADI\TextMagic;

use Textmagic\Services\TextmagicRestClient;


class TextMagic extends TextmagicRestClient
{
    /**
     * TextMagic constructor.
     * @param $username
     * @param $token
     * @param null $version
     * @param null $http
     * @throws \ErrorException
     */
    public function __construct(
        $username = null,
        $token = null,
        $version = null,
        $http = null
    ) {
        if(is_null($username)) {
            $username = config('textmagic.username');
        }
        if(is_null($token)) {
            $token = config('textmagic.token');
        }
        parent::__construct($username,$token,$version,$http);
    }
    /**
     * Overload method for access to models
     *
     * @param string $name Model name
     * @return object
     */
    public function __get($name) {
        $name = strtolower($name);
        
        // Try the standard Textmagic service models
        if (!isset($this->$name)) {
            $className = '\\Textmagic\\Services\\Models\\' . ucfirst($name);

            if(class_exists($className))
                $this->$name = new $className($this);
            else{
                $className .= 's';
                if(class_exists($className))
                    $this->$name = new $className($this);
            }
        }

        // Now try the CloudLink service models
        if (!isset($this->$name)) {
            $className = '\\CloudLinkADI\\TextMagic\\Services\\Models\\' . ucfirst($name);

            if(class_exists($className))
                $this->$name = new $className($this);
            else{
                $className .= 's';
                if(class_exists($className))
                    $this->$name = new $className($this);
            }
        }

        return $this->$name;
    }

    /**
     * Overload method for access to models functions
     *
     * @param string $name Model name
     * @return object
     * @throws \ErrorException
     */
    public function __call($name, $arguments)
    {
        $arguments[0] = isset($arguments[0]) ? $arguments[0] : null;

        $SingleArgumentMethods = [
            ['get','Lists'],
            ['get','List'],
            ['get','Contacts'],
            ['get','Contact'],
            ['get','Price'],
            ['get','Available'],
            ['get','Messages'],
            ['get','Lookups'],
            ['create','Contacts'],
            ['create','Contact'],
            ['delete','Contacts'],
            ['delete','Contact'],
        ];
        foreach ($SingleArgumentMethods as $method)
        {
            $methodName = implode('',$method);
            if(starts_with($name,$method[0]) && ends_with($name,$method[1]) && $methodName != $name)
            {
                $modelName = trim(str_replace($method,['',''],$name));
                return $this->$modelName->$methodName($arguments[0]);
            }
        }

        if(starts_with($name,'get'))
        {
            $modelName = trim(str_replace('get','',$name));
            return $this->$modelName->get($arguments[0]);
        }
        elseif(starts_with($name,'create'))
        {
            $modelName = trim(str_replace('create','',$name));
            return $this->$modelName->create($arguments[0]);
        }
        elseif(starts_with($name,'update') && ends_with($name,'Contacts'))
        {
            $modelName = trim(str_replace(['update','Contacts'],['',''],$name));
            return $this->$modelName->updateContacts($arguments[0],$arguments[1]);
        }
        elseif(starts_with($name,'update') && ends_with($name,'Contact'))
        {
            $modelName = trim(str_replace(['update','Contact'],['',''],$name));
            return $this->$modelName->updateContact($arguments[0],$arguments[1]);
        }
        elseif(starts_with($name,'update'))
        {
            $modelName = trim(str_replace('update','',$name));
            return $this->$modelName->update($arguments[0],$arguments[1]);
        }
        elseif(starts_with($name,'delete'))
        {
            $modelName = trim(str_replace('delete','',$name));
            return $this->$modelName->delete($arguments[0]);
        }
        elseif(starts_with($name,'search'))
        {
            $modelName = trim(str_replace('search','',$name));
            return $this->$modelName->delete($arguments[0]);
        }

        throw new \ErrorException('Method does not exists');
    }

    /**
     * Functions that they are overwritten in Models
     */
    
    public function spendingStats($params = array())
    {
        $this->stats->spending($params);
    }

    public function messagingStats($params = array())
    {
        $this->stats->messaging($params);
    }


    public function ping() {
        return $this->utils->ping();
    }

    public function getUser()
    {
        return $this->retrieveData('user');
    }

    public function updateUser($params = array())
    {
        return $this->retrieveData('user',$params);
    }
}



