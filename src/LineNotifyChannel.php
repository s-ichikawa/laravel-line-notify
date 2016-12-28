<?php
namespace Sichikawa\LaravelLineNotify;

use Illuminate\Notifications\Notification;

class LineNotifyChannel
{

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toVoice($notifiable);

        // 通知を$notifiableインスタンスへ送信する…
    }
}