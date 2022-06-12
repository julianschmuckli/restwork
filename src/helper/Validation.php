<?php
namespace Julianschmuckli\Restwork;

class Validation
{

    /**
     * Validates the input to a string.
     * @param string $input A string which should be validated.
     * @return string
     */
    public static function string($input)
    {
        return htmlspecialchars(trim($input));
    }

    /**
     * Validates the input to an int.
     * @param string $input A number which should be converted to an integer.
     * @return int
     */
    public static function int($input)
    {
        return intval(self::string($input));
    }

    /**
     * Validates the input to a boolean.
     * @param string $input A value, which can fit to a boolean.
     * @return boolean
     */
    public static function boolean($input)
    {
        return boolval(self::string($input));
    }

    /**
     * Validates the input to a JSON Object/Array.
     * @param string $input A json encoded string.
     * @return object
     */
    public static function json($input)
    {
        return json_decode($input, true);
    }

    /**
     * Source: https://stackoverflow.com/questions/13124072/how-to-programmatically-find-public-properties-of-a-class-from-inside-one-of-it
     * @param object $object The object which should return only the public vars.
     * @return array
     */
    public static function getObjectPublicVars($object) : array {
        return get_object_vars($object);
    }
}
