<?php

namespace Rave\Core\International;

class I18n
{
    private $language;
    private $parsed = [];

    const FRENCH = 'fr_FR';
    const ENGLISH = 'en_US';

    private static $instance;

    const PATH = 'localization';

    private function __construct()
    {
        if (preg_match('#^fr(\S+)#', $_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $this->language = self::FRENCH;
        } else {
            $this->language = self::ENGLISH;
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function parse()
    {
        if (!isset($this->parsed[$this->language])) {
            $this->parsed[$this->language] = json_decode(file_get_contents(ROOT . '/' . self::PATH . '/' . $this->language . '.json'));
        }
        return ['i18n' => $this->parsed[$this->language]];
    }
}