<?php
namespace NotificationChannels\LineNotify\Exceptions;

class CouldNotCreateMessage extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static("Descriptive error message.");
    }

    public static function textTooLong()
    {
        return new static("Message over max length.");
    }
}