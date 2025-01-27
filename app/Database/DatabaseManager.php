<?php

namespace App\Database;

use PDO;

class DatabaseManager
{
    public function __construct(protected ?PDO $pdo = null, protected ?PDO $connection = null)
    {
        $params = [
            'driver' => 'mysql',
            'host' => 'snapp-db',
            'database' => 'snapp_db',
            'username' => 'snapp_db_user',
            'password' => '123456',
        ];
        $connectionString = $params['driver'].':host='.$params['host'].';dbname='.$params['database'];
        if (! $this->pdo) {
            try {
                $this->connection = new PDO($connectionString, $params['username'], $params['password']);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                print_r($e->getMessage());
                exit();
            }
        }
        print_r($pdo);
    }

    public function __destruct()
    {
        //        $this->connection ? $this->connection->disconnect() : $this->connection = null;
    }

    public function executeQuery(string $query, array $parameters = []): mixed
    {
        $statement = $this->connection
            ->prepare($query, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true]);
        $statement->execute($parameters);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getLastInsertedItem(): mixed
    {
        return $this->connection->lastInsertId();
    }
}
