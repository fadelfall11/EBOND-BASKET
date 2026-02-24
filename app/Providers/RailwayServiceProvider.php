<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RailwayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Parse DATABASE_URL from Railway if present
        if ($databaseUrl = env('DATABASE_URL')) {
            $this->parseDatabaseUrl($databaseUrl);
            return;
        }

        $this->mapRailwayPluginVariables();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Parse DATABASE_URL env variable (Railway format)
     * Format: mysql://user:password@host:port/database
     */
    private function parseDatabaseUrl(string $url): void
    {
        $parsed = parse_url($url);

        if (!$parsed) {
            return;
        }

        // Set individual database config from parsed URL
        $scheme = $parsed['scheme'] ?? 'mysql';
        $host = $parsed['host'] ?? env('DB_HOST', '127.0.0.1');
        $port = $parsed['port'] ?? env('DB_PORT', 3306);
        $database = ltrim($parsed['path'] ?? '', '/') ?: env('DB_DATABASE');
        $username = $parsed['user'] ?? env('DB_USERNAME', 'root');
        $password = $parsed['pass'] ?? env('DB_PASSWORD', '');

        // Store parsed values in environment for config/database.php to use
        putenv("DB_CONNECTION={$scheme}");
        putenv("DB_HOST={$host}");
        putenv("DB_PORT={$port}");
        putenv("DB_DATABASE={$database}");
        putenv("DB_USERNAME={$username}");
        putenv("DB_PASSWORD={$password}");
    }

    private function mapRailwayPluginVariables(): void
    {
        $mysqlHost = getenv('MYSQLHOST') ?: getenv('RAILWAY_MYSQL_HOST');
        $mysqlPort = getenv('MYSQLPORT') ?: getenv('RAILWAY_MYSQL_PORT');
        $mysqlDb = getenv('MYSQLDATABASE') ?: getenv('MYSQL_DB');
        $mysqlUser = getenv('MYSQLUSER') ?: getenv('MYSQL_USERNAME');
        $mysqlPassword = getenv('MYSQLPASSWORD') ?: getenv('MYSQL_PASSWORD');

        if ($mysqlHost && $mysqlDb && $mysqlUser) {
            putenv('DB_CONNECTION=mysql');
            putenv("DB_HOST={$mysqlHost}");
            if ($mysqlPort) {
                putenv("DB_PORT={$mysqlPort}");
            }
            putenv("DB_DATABASE={$mysqlDb}");
            putenv("DB_USERNAME={$mysqlUser}");
            putenv("DB_PASSWORD={$mysqlPassword}");
            return;
        }

        $pgHost = getenv('PGHOST') ?: getenv('POSTGRES_HOST') ?: getenv('RAILWAY_POSTGRES_HOST');
        $pgPort = getenv('PGPORT') ?: getenv('POSTGRES_PORT') ?: getenv('RAILWAY_POSTGRES_PORT');
        $pgDb = getenv('PGDATABASE') ?: getenv('POSTGRES_DB');
        $pgUser = getenv('PGUSER') ?: getenv('POSTGRES_USER');
        $pgPassword = getenv('PGPASSWORD') ?: getenv('POSTGRES_PASSWORD');

        if ($pgHost && $pgDb && $pgUser) {
            putenv('DB_CONNECTION=pgsql');
            putenv("DB_HOST={$pgHost}");
            if ($pgPort) {
                putenv("DB_PORT={$pgPort}");
            }
            putenv("DB_DATABASE={$pgDb}");
            putenv("DB_USERNAME={$pgUser}");
            putenv("DB_PASSWORD={$pgPassword}");
        }
    }
}
