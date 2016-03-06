<?php

namespace rave\lib\core\io;

use rave\core\exception\FileTypeException;
use rave\core\exception\IOException;
use rave\core\exception\UploadException;

class File
{

    public static function checkSum($filePath)
    {
        return file_exists($filePath) ? hash('sha1', file_get_contents($filePath)) : null;
    }

    /**
     * Move the file in the $uploadPath or gets the existing file from it, using sha1 as a comparator
     * @param string $fileName
     * @param string $uploadPath
     * @param array $extensions
     * @param array $mimeTypes
     * @return string
     * @throws FileTypeException
     * @throws IOException
     * @throws UploadException
     */
    public static function moveUploadedFile(string $fileName, string $uploadPath, array $extensions = [], array $mimeTypes = [])
    {
        if (isset($_FILES[$fileName]) === false) {
            throw new UploadException('Can not find uploaded file in super global FILES');
        }

        $fileExtension = strrchr($_FILES[$fileName]['name'], '.');

        if (empty($extensions) === false && in_array($fileExtension, $extensions) === false) {
            throw new FileTypeException('Wrong file extension');
        }

        $uploadedFileName = sha1_file($_FILES[$fileName]['tmp_name']) . $fileExtension;

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