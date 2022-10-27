<?php

namespace Pyrus;

use Pyrus\Entities\Catalogs;
use Pyrus\Entities\Comments;
use Pyrus\Entities\Files;
use Pyrus\Entities\Forms;
use Pyrus\Entities\Members;
use Pyrus\Entities\Tasks;
use Pyrus\Library\Pyrus;

class Factory
{
    const ENTITIES = [
        'tasks' => Tasks::class,
        'comments' => Comments::class,
        'files' => Files::class,
        'catalogs' => Catalogs::class,
        'members' => Members::class,
        'forms' => Forms::class
    ];

    private static function initPyrus($bot_login, $bot_secret): Pyrus
    {
        $http = new \GuzzleHttp\Client();
        $pyrus = new Pyrus($http);
        $pyrus->setHeaders($bot_login, $bot_secret);
        return $pyrus;
    }

    public static function init(string $bot_login, string $bot_secret, ?array $entities = null): Client
    {
        $pyrus = self::initPyrus($bot_login, $bot_secret);
        $client = new Client();
        $init_list = is_null($entities) ? array_keys(self::ENTITIES) : $entities;

        foreach ($init_list as $entity){
            $class = self::ENTITIES[$entity];
            $client->$entity = new $class($pyrus);
        }

        return $client;
    }
}