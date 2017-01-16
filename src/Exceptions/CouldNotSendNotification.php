<?php
namespace NotificationChannels\LineNotify\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function lineNotifyTokenNotProvided($msg)
    {
        return new static($msg);
    }

    public static function couldNotCommunicateWithLineNotify($exception)
    {
        return new static($exception);
    }

    public static function lineNotfyRespondedWithAnError($exception)
    {
        return new static($exception);
    }

}