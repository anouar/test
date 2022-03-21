<?php

declare(strict_types=1);

namespace App;

use App\Config;
use PDO;

class Dao
{
    protected static $instance = null;

    public static function instance()
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        $config = new Config($_ENV);

        if (self::$instance === null) {
            try {
                self::$instance = new \PDO(
                    'mysql:host=' .  $config->db['host'] . ';dbname=' .  $config->db['database'],
                    $config->db['user'],
                    $config->db['pass'],
                    $config->db['options'] ?? $defaultOptions
                );
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function fetchAll($query, $values = null)
    {
        try {
            $pre = self::instance()->prepare($query);
            if (isset($values)) {
                $pre->execute($values);
            } else {
                $pre->execute();
            }
            return $pre->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function update($query, $values = null)
    {
        try {
            $pre = self::instance()->prepare($query);
            if (isset($values)) {
                $pre->execute($values);
            } else {
                $pre->execute();
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}
