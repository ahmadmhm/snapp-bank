<?php

namespace App\Database\Repositories;

use App\Database\DatabaseManager;

class TransactionRepository
{
    public function __construct(protected ?DatabaseManager $dbm = null)
    {
        $this->dbm = empty($this->dbm) ? new DatabaseManager : $this->dbm;
    }

    public function findById(int $id)
    {
        return $this->dbm->executeQuery('SELECT * FROM transactions WHERE id = ?', [$id]);
    }

    public function createTransaction(array $data)
    {
        $this->dbm
            ->executeQuery('INSERT INTO transactions (amount, description, user_id, bank_id, current_balance) 
                VALUES (:amount, :description, :user_id, :bank_id, :current_balance)', $data);

        return $this->findById($this->dbm->getLastInsertedItem());
    }
}
