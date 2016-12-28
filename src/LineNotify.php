<?php
namespace Sichikawa\LaravelLineNotify;


class LineNotify
{
    /**
     * @var null|string token.
     */
    protected $token;


    /**
     * LineNotify constructor.
     * @param null $token
     */
    public function __construct($token = null)
    {
        $this->token = $token;

    }


}