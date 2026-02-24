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
        }
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
}
