<?php
namespace NotificationChannels\LineNotify;

use Illuminate\Notifications\Notification;

class LineNotifyChannel
{
    /**
     * @var LineNotify
     */
    private $lineNotify;

    /**
     * LineNotifyChannel constructor.
     *
     * @param LineNotify $lineNotify
     */
    public function __construct(LineNotify $lineNotify)
    {

        $this->lineNotify = $lineNotify;
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toLineNotify($notifiable);

        if (is_string($message)) {
            $message = LineNotifyMessage::create($message);
        }
    }
}