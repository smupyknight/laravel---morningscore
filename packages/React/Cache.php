<?php

namespace MorningTrain\Foundation\React;

use Carbon\Carbon;

class Cache
{

    protected function getHash(string $id, string $cache_id = null)
    {
        $directory = md5($id);

        if (is_null($cache_id)) {
            return $directory;
        }

        return "{$directory}/$cache_id";
    }

    protected function getPath(string $hash)
    {
        return storage_path("framework/react-views/{$hash}.html");
    }

    protected function getExpirationTime(string $path, $cache)
    {
        $modifiedAt = Carbon::createFromTimestamp(filemtime($path));

        if (is_int($cache)) {
            return $modifiedAt->addSeconds($cache);
        }

        switch ($cache) {
            case 'hourly':
                return $modifiedAt->addHour();

            case 'daily':
                return $modifiedAt->addDay();

            case 'weekly':
                return $modifiedAt->addWeek();

            case 'monthly':
                return $modifiedAt->addMonth();

            case 'yearly':
                return $modifiedAt->addYear();
        }

        return $modifiedAt;
    }

    protected function hasContents(string $path, $cache)
    {
        if ($cache === false) {
            if (file_exists($path)) {
                unlink($path);
            }

            return false;
        }

        if (!file_exists($path)) {
            return false;
        }

        if (($cache !== 'forever') && $this->getExpirationTime($path, $cache) < Carbon::now()) {
            unlink($path);
            return false;
        }

        return true;
    }

    public function getContents(string $id, $cache)
    {
        $cache_id = 'default';

        if (is_array($cache)) {
            $cache_id = $cache['id'] ?? 'default';
            $cache = $cache['span'] ?? 'never';
        }

        if ($cache === 'never') {
            $cache = false;
        }

        $hash = $this->getHash($id, $cache_id ?: 'default');
        $path = $this->getPath($hash);

        return $this->hasContents($path, $cache) ?
            file_get_contents($path) :
            null;
    }

    public function setContents(string $id, string $contents, $cache)
    {
        $cache_id = 'default';

        if (is_array($cache)) {
            $cache_id = $cache['id'] ?? 'default';
            $cache = $cache['span'] ?? 'never';
        }

        if (($cache !== false) && ($cache !== 'never')) {
            $hash = $this->getHash($id, $cache_id ?: 'default');
            $path = $this->getPath($hash);
            $directory = dirname($path);

            if (!file_exists($directory)) {
                mkdir($directory);
            }

            file_put_contents($path, $contents);
        }

        return $this;
    }

    public function removeContents(string $id)
    {
        $path = $this->getPath($this->getHash($id, null) . '/*');

        foreach (glob($path) as $file) {
            unlink($file);
        }

        return $this;
    }

}