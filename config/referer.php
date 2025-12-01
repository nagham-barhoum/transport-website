<?php

return [

    /*
     * The key that will be used to remember the referer in the session.
     */
    'session_key' => 'referer',

    /*
     * The sources that will be used to detect the referer.
     */
    'sources' => [
        'utm_source' => 'utm_source',
        'referer' => 'referer',
        'landing_page' => 'landing_page',
    ],
];
