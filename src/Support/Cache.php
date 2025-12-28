<?php

class Cache
{
    private static $cacheDir;

    /**
     * Initialize cache directory
     */
    private static function init()
    {
        if (!self::$cacheDir) {
            self::$cacheDir = __DIR__ . '/../../data';
            if (!is_dir(self::$cacheDir)) {
                @mkdir(self::$cacheDir, 0777, true);
            }
        }
    }

    /**
     * Get cached data or fetch from callback
     * 
     * @param string $key Cache key (filename without extension)
     * @param callable $callback Function to fetch fresh data
     * @param int $ttl Time to live in seconds (default: 3600 = 1 hour)
     * @return mixed Cached or fresh data
     */
    public static function remember($key, $callback, $ttl = 3600)
    {
        self::init();
        
        $dataPath = self::$cacheDir . "/$key.json";

        // Check if cache exists and is valid
        if (file_exists($dataPath)) {
            $data = json_decode(file_get_contents($dataPath), true);
            
            if (isset($data['timestamp']) && (time() - $data['timestamp']) < $ttl) {
                return $data['data'];
            }
        }

        // Fetch fresh data
        $freshData = $callback();
        
        if ($freshData !== false && $freshData !== null) {
            $store = [
                'timestamp' => time(),
                'date' => date("Y-m-d"),
                'hour' => date("H"),
                'data' => $freshData
            ];
            file_put_contents($dataPath, json_encode($store));
            return $freshData;
        }

        // Return cached data if fetch failed
        if (isset($data['data'])) {
            return $data['data'];
        }

        return [];
    }

    /**
     * Clear specific cache or all cache
     * 
     * @param string|null $key Cache key to clear, or null to clear all
     */
    public static function clear($key = null)
    {
        self::init();
        
        if ($key === null) {
            $files = glob(self::$cacheDir . "/*.json");
            foreach ($files as $file) {
                @unlink($file);
            }
        } else {
            $dataPath = self::$cacheDir . "/$key.json";
            if (file_exists($dataPath)) {
                @unlink($dataPath);
            }
        }
    }
}
