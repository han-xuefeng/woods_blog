<?php

namespace App\Providers;

use App\Events\CommentChange;
use App\Events\PostChange;
use App\Listeners\ClearCommentCache;
use App\Listeners\ClearPostCache;
use App\Listeners\EmailVerified;
use App\Listeners\EnvironmentSave;
use App\Listeners\InstallerFinish;
use Flex\Installer\Events\EnvironmentSaved;
use Flex\Installer\Events\LaravelInstallerFinished;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Verified::class => [
            EmailVerified::class,
        ],
        PostChange::class => [
            ClearPostCache::class,
        ],
        CommentChange::class => [
            ClearCommentCache::class,
        ],
        EnvironmentSaved::class => [
            EnvironmentSave::class
        ],
        LaravelInstallerFinished::class => [
            InstallerFinish::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
