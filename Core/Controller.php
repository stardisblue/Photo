<?php

namespace Rave\Core;

use Rave\Core\Exception\IOException;
use Rave\Core\International\I18n;
use Rave\Library\Core\Security\Auth;

abstract class Controller
{
    const LOG_NOTICE = 0;
    const LOG_WARNING = 1;
    const LOG_FATAL_ERROR = 2;

    protected $data = [];

    protected $i18n = false;
    protected $layout = false;

    private static $currentLogFile;

    protected function loadView(string $view, array $data = [])
    {
        $admin = Auth::check('admin');

        if (!empty($data) || !empty($this->data)) {
            extract(array_merge($this->data, $data));
        }

        if ($this->i18n) {
            extract(I18n::getInstance()->parse());
        }

        $controller = explode('\\', get_class($this));

        $file = ROOT . '/Application/View/' . end($controller) . '/' . $view . '.php';

        ob_start();

        if (file_exists($file)) {
            include_once $file;
        } else {
            Error::create('Erreur chargement vue', 404);
        }

        $content = ob_get_clean();

        if (!$this->layout) {
            echo $content;
        } else {
            include_once ROOT . '/Application/View/Layout/' . $this->layout . '.php';
        }
    }

    protected function redirect(string $page = '')
    {
        header('Location: ' . WEB_ROOT . '/' . $page);
        exit;
    }

    protected function log(string $message, int $priority = self::LOG_NOTICE)
    {
        $log = date('H:i:s');

        switch ($priority) {
            case self::LOG_NOTICE:
                $log .= ' : ' . $message;
                break;
            case self::LOG_WARNING:
                $log .= ' WARNING : ' . $message;
                break;
            case self::LOG_FATAL_ERROR:
                $log .= ' FATAL ERROR : ' . $message;
                break;
        }

        try {
            $this->writeLog($log);
        } catch (IOException $ioException) {
            Error::create($ioException->getMessage(), 500);
        }
    }

    private function writeLog(string $message)
    {
        if (isset(self::$currentLogFile)) {
            file_put_contents(self::$currentLogFile, $message . PHP_EOL, FILE_APPEND);
        } else {
            if (file_exists(ROOT . '/log') === false) {
                mkdir(ROOT . '/log');
            }

            self::$currentLogFile = ROOT . '/log/' . date('d-m-Y') . '.log';

            if (!file_exists(self::$currentLogFile) && !fopen(self::$currentLogFile, 'a')) {
                throw new IOException('Unable to create log file');
            }

            $this->writeLog($message);
        }
    }

    protected function setLayout($layout, array $data = [])
    {
        $this->data = $data;
        $this->layout = file_exists(ROOT . '/Application/View/Layout/' . $layout . '.php') ? $layout : false;
    }

    protected function setI18n(bool $status)
    {
        $this->i18n = $status;
    }

}