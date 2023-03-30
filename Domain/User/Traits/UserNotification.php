<?php

namespace App\Domain\User\Traits;

use Illuminate\Notifications\Notifiable;

trait UserNotification
{
    use Notifiable;

    public function notificationsByType($type)
    {
        return $this->notifications()->where("type", $type);
    }

    public function unreadNotificationsByType($type)
    {
        return $this->notificationsByType($type)->unread();
    }

    public function readNotificationsByType($type)
    {
        return $this->notificationsByType($type)->read();
    }
}
