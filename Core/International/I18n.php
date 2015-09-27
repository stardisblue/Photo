<?php

namespace Rave\Core\International;

class I18n
{
    private $_language;
    private $_parsed = [];

    const FRENCH = 'fr_FR';
    const ENGLISH = 'en_US';

    private static $_instance;

    const PATH = 'localization';

    private function __construct()
    {
        if (preg_match('#^fr(\S+)#', $_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $this->_language = self::FRENCH;
        } else {
            $this->_language = self::ENGLISH;
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function parse()
    {
        if (!isset($this->_parsed[$this->_language])) {
            $this->_parsed[$this->_language] = json_decode(file_get_contents(ROOT . '/' . self::PATH . '/' . $this->_language . '.json'));
        }

        return ['i18n' => $this->_parsed[$this->_language]];
    }

}