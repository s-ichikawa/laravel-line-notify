<?php
namespace NotificationChannels\LineNotify;


use Illuminate\Support\ServiceProvider;

class LineNotifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(LineNotifyChannel::class)
            ->needs(LineNotify::class)
            ->give(function () {
                $token = config('services.line_notify.token');

                return new LineNotify($token);
            });
    }
}