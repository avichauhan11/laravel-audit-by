<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Identity Sources (checked in order)
    |--------------------------------------------------------------------------
    */

    'sources' => [

        [
            'driver' => 'auth',
            'guards' => ['admin', 'web', 'api'],
        ],

        [
            'driver' => 'session',
            'keys' => [
                'admin.id',
                'staff.id',
                'user.id',
            ],
        ],

        // [
        //     'driver' => 'callback',
        //     'resolver' => fn () => request()->header('X-USER-ID'),
        // ],
    ],

];
