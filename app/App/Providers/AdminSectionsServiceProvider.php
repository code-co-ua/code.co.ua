<?php

namespace App\Providers;

use Domain\Exercise\Server;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;
use App\Http\Sections\Servers;

class AdminSectionsServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $sections = [
        # todo - get back old sleepingowl code from bitbucket
        Server::class => Servers::class,
    ];

    public function boot(Admin $admin): void
    {
    	//

        parent::boot($admin);
    }
}
