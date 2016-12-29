<?php
namespace NotificationChannels\LineNotify;

class LineNotifyMessage
{
    /** @var string Notification Text. */
    public $text;

    /**
     * @param string $text
     *
     * @return static
     */
    public static function create($text = '')
    {
        return new static($text);
    }

    /**
     * @param string $text
     */
    public function __construct($text = '')
    {
        if ($text != '') {
            $this->text($text);
        }
    }


    /**
     * Notification text.
     *
     * @param $text
     *
     * @throws CouldNotCreateMessage
     *
     * @return $this
     */
    public function text($text)
    {
        if (mb_strlen($text) > 320) {
            throw CouldNotCreateMessage::textTooLong();
        }
        $this->text = $text;
        $this->hasText = true;
        return $this;
    }
}