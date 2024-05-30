<?php

/**
 * Fluent Forms Utils
 * 
 * Wrappers for Fluent Forms functions.
 * 
 * @package WPGraphQL\FluentForms\Utils
 */


namespace WPGraphQL\FluentForms\Utils;

use DateTime;

class FFUtils
{
    public static function getForm($formId)
    {
        return fluentFormApi('forms')->form($formId);
    }

    // public static function getForms()
    // {
    //     return self::$formApi->forms();
    // }

    public static function getIsoDateTime($ormDateTime)
    {
        $datetime = new DateTime(strval($ormDateTime));
        return $datetime->format(DateTime::ATOM); // Updated ISO8601
    }
}
