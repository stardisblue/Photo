<?php

namespace rave\core\international;

class I18n
{
    const FRENCH = 'fr_FR';
    const ENGLISH = 'en_US';
    const PATH = 'localization';

    /**
     * @deprecated
     */
    private static $instance;
    private $language;
    private $parsed = [];

    public function __construct()
    {
        if (preg_match('#^fr(\S+)#', $_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $this->language = self::FRENCH;
        } else {
            $this->language = self::ENGLISH;
        }
    }

    /**
     * @return I18n
     * @deprecated use Dependancy injection instead
     */
    public static function getInstance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function parse()
    {
        if (!isset($this->parsed[$this->language])) {
            $this->parsed[$this->language] = json_decode(file_get_contents(ROOT . '/' . self::PATH . '/' . $this->language . '.json'));
        }
        return ['i18n' => $this->parsed[$this->language]];
    }
}