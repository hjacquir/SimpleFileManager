<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Notifier;

/**
 * Class DataTransferObject
 * @package Hj\Notifier
 */
class DataTransferObject
{
    /**
     * @var Notification
     */
    private $notification;

    public function __construct()
    {
        $this->notification = new Notification();
    }

    /**
     * @param Notification $notification
     */
    public function setNotification(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @return Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }
}