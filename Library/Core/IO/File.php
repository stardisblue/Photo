<?php

namespace Rave\Library\Core\IO;

use Rave\Core\Exception\FileTypeException;
use Rave\Core\Exception\IOException;
use Rave\Core\Exception\UploadException;

class File
{

    public static function checkSum($filePath)
    {
        return file_exists($filePath) ? hash('sha1', file_get_contents($filePath)) : null;
    }

    public static function moveUploadedFile(string $fileName, string $uploadPath, array $extensions = [], array $mimeTypes = [])
    {
        if (isset($_FILES[$fileName]) === false) {
            throw new UploadException('Can not find uploaded file in superglobale FILES');
        }

        $fileExtension = strrchr($_FILES[$fileName]['name'], '.');

        if (empty($extensions) === false && in_array($fileExtension, $extensions) === false) {
            throw new FileTypeException('Wrong file extension');
        }

        $uploadedFileName = hash_file('sha1', $_FILES[$fileName]['tmp_name']) . $fileExtension;

        if (!file_exists($uploadedFileName)) {

            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);

            if (empty($mimeTypes) === false && in_array(finfo_file($fileInfo, $_FILES[$fileName]['tmp_name']), $mimeTypes) === false) {
                throw new FileTypeException('Wrong MIME type');
            }

            if (!is_writable(ROOT . '/' . $uploadPath)) {
                throw new IOException('Cannot write in destination directory');
            }

            finfo_close($fileInfo);

            if (move_uploaded_file($_FILES[$fileName]['tmp_name'], ROOT . '/' . $uploadPath . '/' . $uploadedFileName) === false) {
                throw new IOException('Failed to move the uploaded file');
            }
        }

        return $uploadedFileName;
    }

}