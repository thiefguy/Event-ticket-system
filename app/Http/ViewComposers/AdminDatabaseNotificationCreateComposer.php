<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Contracts \{
    NotificationRepoInterface,
    UserRepoInterface
}; //php7 grouping use statements

class AdminDatabaseNotificationCreateComposer
{
    protected $userRepo;
    protected $notificationRepo;

    /**
     * AdminDatabaseNotificationCreateComposer constructor.
     * @param NotificationRepoInterface $notificationRepo
     * @param UserRepoInterface $userRepo
     */
    public function __construct(NotificationRepoInterface $notificationRepo, UserRepoInterface $userRepo)
    {
        $this->notificationRepo = $notificationRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $noOfNotifications = $this->notificationRepo->getTotalNotifications();
        $noOfUsers = $this->userRepo->getTotalUsers();
        $sentNotifcations = round(($noOfNotifications / $noOfUsers)) / 2;
        $allNotifications = $this->notificationRepo->getNotifications();
        $readNotifications = $this->notificationRepo->getReadNotifications();
        $view->with(compact('sentNotifcations', 'readNotifications', 'allNotifications'));
    }
}