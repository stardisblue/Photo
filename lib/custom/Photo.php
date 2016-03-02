<?php

namespace Rave\Library\Custom;

use Rave\Core\Exception\IOException;
use Rave\Core\Exception\FileTypeException;

class Photo
{

    private $_type;
    private $_photo;

    private $_width;
    private $_height;

    const TYPE_PNG = 'PNG';
    const TYPE_JPEG = 'JPEG';

    public function __construct($path, $type)
    {
        $this->_type = $type;

        if ($type === self::TYPE_JPEG) {
            $this->_photo = imagecreatefromjpeg($path);
        } else if ($type === self::TYPE_PNG) {
            $this->_photo = imagecreatefrompng($path);
        } else {
            throw new FileTypeException('Wrong image type');
        }

        $this->_width = imagesx($this->_photo);
        $this->_height = imagesy($this->_photo);
    }

    public function createResized($path, $width, $height)
    {
        $export = imagecreatetruecolor($width, $height);

        imagecopyresized($export, $this->_photo, 0, 0, 0, 0, $width, $height, $this->_width, $this->_height);

        if (!is_writable(dirname($path))) {
            throw new IOException('Destination folder is not writable');
        }

        if ($this->_type === self::TYPE_JPEG) {
            imagejpeg($export, $path, 100);
        } else if ($this->_type === self::TYPE_PNG) {
            imagepng($export, $path, 0);
        }

        imagedestroy($export);
    }

    public function createResizedWidth($path, $size)
    {
        $ratio = $this->_height / $this->_width;
        $this->createResized($path, $size, $size * $ratio);
    }

    public function createResizedHeight($path, $size)
    {
        $ratio = $this->_width / $this->_height;
        $this->createResized($path, $size * $ratio, $size);
    }

}