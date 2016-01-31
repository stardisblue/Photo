<?php

namespace Rave\Library\Core\Security;

class Text
{

    public static function hash($data)
    {
        return hash('sha256', $data);
    }

    public static function clean($data)
    {
        $trimmedData = trim($data);
        $escapedData = stripslashes($trimmedData);
        $cleanedData = htmlspecialchars($escapedData);
        return $cleanedData;
    }

    public static function isEmail($email)
    {
    	return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
	
}