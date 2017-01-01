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

    public static function invalidUrl()
    {
        return new static("Invalid URL.");
    }

    public static function unreadableFile()
    {
        return new static("Unreadable File.");
    }

    public static function invalidStickerId()
    {
        return new static("Invalid sticker id.");
    }
}