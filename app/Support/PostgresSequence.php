<?php

namespace App\Support;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class PostgresSequence
{
    /**
     * Ensure the configured tables have their primary key sequences aligned
     * with the current maximum ID in PostgreSQL databases.
     *
     * @param  array<int, string>  $tables
     */
    public static function sync(array $tables): void
    {
        if (Config::get('database.default') !== 'pgsql' || empty($tables)) {
            return;
        }

        foreach ($tables as $table) {
            if (! is_string($table) || $table === '' || ! Schema::hasTable($table)) {
                continue;
            }

            $sequence = "{$table}_id_seq";

            try {
                $maxId = (int) (DB::table($table)->max('id') ?? 0);
                $nextId = max($maxId + 1, 1);

                DB::statement("SELECT setval('{$sequence}', {$nextId}, false)");
            } catch (\Throwable $e) {
                Log::warning(sprintf(
                    'Failed to synchronize PostgreSQL sequence "%s": %s',
                    $sequence,
                    $e->getMessage()
                ));
            }
        }
    }
}

