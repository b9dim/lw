<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PostgreSQL Sequence Synchronization Tables
    |--------------------------------------------------------------------------
    |
    | These table names will have their "{table}_id_seq" sequence synchronized
    | with the current maximum "id" value whenever the application boots and
    | the default database connection is PostgreSQL. Add more tables if you
    | import data manually and encounter out-of-sync sequences.
    |
    */

    'tables' => [
        'clients',
        'cases',
    ],
];

