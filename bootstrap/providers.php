<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\TelescopeServiceProvider::class,

    App\Modules\Auth\AuthServiceProvider::class,
    App\Modules\User\UserServiceProvider::class,
    App\Modules\Artist\ArtistServiceProvider::class,
    App\Modules\Follow\FollowServiceProvider::class,
    App\Modules\Release\ReleaseServiceProvider::class,
    App\Modules\Account\AccountServiceProvider::class,
    App\Modules\Track\TrackServiceProvider::class,
    App\Modules\Search\SearchServiceProvider::class,
    App\Modules\Player\PlayerServiceProvider::class,
    App\Modules\Collection\CollectionServiceProvider::class
];
