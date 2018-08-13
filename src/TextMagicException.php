<?php

namespace CloudLinkADI\TextMagic;

class TextMagicException extends \ErrorException {
    /**
     * Errors received from Textmagic API
     * @var array
     */
    protected $errors;
    /**
     * TextMagicException constructor
     *
     * @param string $message
     * @param integer $code
     * @param object $errors
     * @return object
     */
    public function __construct($message, $code, $errors = null) {
        $this->errors = $errors;
        parent::__construct($message, $code);
    }
    /**
     * Get errors received from Textmagic API
     *
     * @return array
     */
    public function getErrors() {
        $result = array();
        if (count($this->errors) > 0) {
            if (isset($this->errors['common'])) {
                $result['common'] = $this->errors['common'];
            }
            if (isset($this->errors['fields'])) {
                foreach ($this->errors['fields'] as $key => $value) {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }
}