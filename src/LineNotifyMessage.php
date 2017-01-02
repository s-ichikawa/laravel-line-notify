<?php
namespace NotificationChannels\LineNotify;

use NotificationChannels\LineNotify\Exceptions\CouldNotCreateMessage;

class LineNotifyMessage
{
    /** @var string Notification Text. */
    public $text;

    /**
     * @var string HTTP/HTTPS URL
     */
    public $imageThumbnail;

    /**
     * @var string HTTP/HTTPS URL
     */
    public $imageFullsize;

    /**
     * @var resource File
     */
    public $imageFile;

    /**
     * @var int Number
     */
    public $sticker_package_id;

    /**
     * @var int Number
     */
    public $sticker_id;

    /** @var bool */
    protected $hasText = false;

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
        if (mb_strlen($text) > 1000) {
            throw CouldNotCreateMessage::textTooLong();
        }
        $this->text = $text;
        $this->hasText = true;
        return $this;
    }

    /**
     * @param $url
     * @throws CouldNotCreateMessage
     */
    public function imageThumbnail($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw CouldNotCreateMessage::invalidUrl();
        }
        $this->imageThumbnail = $url;
        return $this;
    }

    /**
     * @param $url
     * @throws CouldNotCreateMessage
     */
    public function imageFullsize($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw CouldNotCreateMessage::invalidUrl();
        }
        $this->imageFullsize = $url;
        return $this;
    }

    /**
     * @param $filename
     * @throws CouldNotCreateMessage
     */
    public function imageFile($filename)
    {
        if (!is_file($filename) || !is_readable($filename)) {
            throw CouldNotCreateMessage::unreadableFile();
        }
        $this->imageFile = $filename;
        return $this;
    }

    /**
     * Sticker.
     * https://devdocs.line.me/files/sticker_list.pdf
     *
     * @param $package_id
     * @param $id
     * @return $this
     * @throws CouldNotCreateMessage
     */
    public function sticker($package_id, $id)
    {
        if (!is_int($package_id) || !is_int($id)) {
            throw CouldNotCreateMessage::invalidStickerId();
        }
        $this->sticker_package_id = $package_id;
        $this->sticker_id = $id;
        return $this;
    }
}
