<?php

namespace CloudLinkADI\TextMagic;

use CloudLinkADI\TextMagic\HttpClient\HttpCurl;
use CloudLinkADI\TextMagic\HttpClient\HttpStream;

class TextMagic
{
    /**
     * Http client instance
     * @var object
     */
    protected $http;

    /**
     * Used version
     * @var string
     */
    protected $version;

    /**
     * Allowed versions
     * @var array
     */
    protected $versions = array('v2');
    /**
     * User agent
     * @var string
     */
    protected $userAgent = 'textmagic-rest-php';

    /**
     * Previous request time for prevent limit exceed error
     * @var integer
     */
    protected $previousRequestTime = 0;

    /**
     * Get the API URI for this client.
     *
     * @return string
     */
    private function getApiUri() {
        return 'https://rest.textmagic.com/api/' . $this->version;
    }

    /**
     * Full user agent with the current PHP Version.
     *
     * @param string $userAgent Application user agent
     * @return string
     */
    private function getFullUserAgent() {
        return $this->userAgent . '/'  . $this->version . ' (php ' . phpversion() . ')';
    }

    /**
     * TextmagicRestClient constructor
     *
     * @param string $username API username
     * @param string $token API token
     * @param string $version API version
     * @param object $http Custom http object
     * @throws \ErrorException
     */
    public function __construct(
        $username,
        $token,
        $version = null,
        $http = null
    ) {
        $this->version = in_array($version, $this->versions) ? $version : end($this->versions);
        $this->http = $http;
        if (null === $this->http) {
            if (!in_array('openssl', get_loaded_extensions())) {
                throw new \ErrorException('The OpenSSL extension is required but not currently enabled. For more information, see http://php.net/manual/en/book.openssl.php');
            }
            if (in_array('curl', get_loaded_extensions())) {
                $this->http = new HttpCurl(
                    $this->getApiUri(),
                    array(
                        'curl_options' => array(
                            CURLOPT_USERAGENT => $this->getFullUserAgent(),
                            CURLOPT_HTTPHEADER => array(
                                'Accept-Charset: utf-8',
                                'Accept-Language: en-US'
                            )
                        )
                    )
                );
            } else {
                $this->http = new HttpStream(
                    $this->getApiUri(),
                    array(
                        'http_options' => array(
                            'http' => array(
                                'user_agent' => $this->getFullUserAgent(),
                                'header' => array(
                                    'Accept-Charset: utf-8',
                                    'Accept-Language: en-US'
                                )
                            ),
                            'ssl' => array(
                                'verify_peer' => true,
                                'verify_depth' => 5
                            )
                        )
                    )
                );
            }
        }

        $this->http->authenticate($username, $token);
    }
    /**
     * Overload method for access to models
     *
     * @param string $name Model name
     * @return object
     */
    public function __get($name) {
        $name = strtolower($name);
        if (!isset($this->$name)) {
            $className = __NAMESPACE__ . '\\Models\\' . ucfirst($name);

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
     * POST to resource at the specified path
     *
     * @param string $path Path to resource
     * @param array  $params Query string parameters
     * @throws TextMagicException
     * @return array
     */
    public function createData($path, $params = array()) {
        return $this->makeRequest(
            'POST',
            $path,
            array('Content-Type' => 'application/x-www-form-urlencoded'),
            http_build_query($params)
        );
    }
    /**
     * DELETE resource at the specified path
     *
     * @param string $path Path to resource
     * @param array  $params Query string parameters
     * @throws TextMagicException
     * @return array
     */
    public function deleteData($path, $params = array()) {
        return $this->makeRequest(
            'DELETE',
            $path,
            array('Content-Type' => 'application/x-www-form-urlencoded'),
            http_build_query($params)
        );
    }
    /**
     * GET resource at the specified path
     *
     * @param string $path Path to resource
     * @param array  $params Query string parameters
     * @throws TextMagicException
     * @return array
     */
    public function retrieveData($path, $params = array()) {
        return $this->makeRequest(
            'GET',
            $path,
            array(),
            http_build_query($params)
        );
    }
    /**
     * PUT resource at the specified path
     *
     * @param string $path Path to resource
     * @param array  $params Query string parameters
     * @throws TextMagicException
     * @return array
     */
    public function updateData($path, $params = array()) {
        return $this->makeRequest(
            'PUT',
            $path,
            array('Content-Type' => 'application/x-www-form-urlencoded'),
            http_build_query($params)
        );
    }

    /**
     * Method for implementing request retry logic
     *
     * @param string $method HTTP request method
     * @param string $path Path to resource
     * @throws TextMagicException
     * @return array
     */
    private function makeRequest($method, $path, $headers = array(), $params = '') {
        if (time() - $this->previousRequestTime < 1) {
            sleep(1);
        }
        $response = call_user_func_array(array($this->http, $method), array($path, $headers, $params));
        $this->previousRequestTime = time();
        list($status, $headers, $body) = $response;
        return $this->processResponse($response);
    }
    /**
     * Convert the JSON encoded response into a PHP object.
     *
     * @param array $response JSON encoded server response
     * @throws TextMagicException
     * @return array|bool
     */
    private function processResponse($response) {
        list($status, $headers, $body) = $response;
        // if empty response just return boolean
        if ($status == 204) {
            return true;
        }

        $decoded = json_decode($body, true);
        if ($decoded === null) {
            throw new TextMagicException('Could not decode response body as JSON.', $status);
        }
        if (200 <= $status && $status < 300) {
            return $decoded;
        }
        throw new TextMagicException(
            $decoded['message'],
            $decoded['code'],
            (isset($decoded['errors']) ? $decoded['errors'] : null)
        );
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

    /**
     * @return array
     * @throws \CloudLinkADI\TextMagic\TextMagicException
     * @throws \ErrorException
     */
    public function ping() {
        return $this->utils->ping();
    }
}