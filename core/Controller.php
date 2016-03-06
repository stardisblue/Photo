<?php

namespace rave\core;

use rave\core\exception\IOException;
use rave\core\international\I18n;

abstract class Controller
{
    const LOG_NOTICE = 0;
    const LOG_WARNING = 1;
    const LOG_FATAL_ERROR = 2;
    private static $currentLogFile;
    protected $data = [];
    protected $i18n = false;
    protected $layout = false;

    public function beforeCall(string $method)
    {
    }

    protected function loadView(string $view, array $data = [])
    {
        if (!empty($data) || !empty($this->data)) {
            extract(array_merge($this->data, $data));
        }

        if ($this->i18n) {
            extract(I18n::getInstance()->parse());
        }

        $controller = explode('\\', static::class);

        $file = ROOT . '/app/view/' . strtolower(end($controller)) . '/' . $view . '.php';

        ob_start();

        if (file_exists($file)) {
            /** @noinspection PhpIncludeInspection */
            include_once $file;
        } else {
            Error::create('Error while loading view', 404);
        }

        $content = ob_get_clean();

        if (!$this->layout) {
            echo $content;
        } else {
            /** @noinspection PhpIncludeInspection */
            include_once ROOT . '/app/view/layout/' . $this->layout . '.php';
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

    protected function setLayout(string $layout, array $data = [])
    {
        $this->data = $data;
        $this->layout = file_exists(ROOT . '/app/view/layout/' . $layout . '.php') ? $layout : false;
    }

    protected function setI18n(bool $status)
    {
        $this->i18n = $status;
    }

}