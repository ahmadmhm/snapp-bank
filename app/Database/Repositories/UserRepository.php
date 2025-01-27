<?php

namespace App\Database\Repositories;

use App\Database\DatabaseManager;

class UserRepository
{
    public function __construct(protected ?DatabaseManager $dbm = null)
    {
        $this->dbm = new DatabaseManager;
    }

    public function findById(int $id)
    {
        return $this->dbm->executeQuery('SELECT * FROM users WHERE id = ?', [$id]);
    }

    public function updateUser(int $id, array $data)
    {
        $user = $this->findById($id);
        if (! empty($user)) {
            $data = [
                'name' => $data['name'] ?? $user['name'],
                'mobile' => $data['mobile'] ?? $user['mobile'],
                'balance' => $user['balance'],
                'id' => $id,
            ];
            $this->dbm
                ->executeQuery('UPDATE users SET name=:name, mobile=:mobile, balance=:balance WHERE id=:id', $data);

            return $this->findById($id);
        }

        return null;
    }

    public function increaseBalance(int $userId, int $amount)
    {
        $user = $this->findById($userId);
        if (! empty($user)) {
            $transactionData = [
                'user_id' => $userId,
                'bank_id' => 1,
                'amount' => $amount,
                'current_balance' => $user['balance'] + $amount,
                'description' => 'Incrementing the balance',
            ];
            $transactionRepository = new TransactionRepository($this->dbm);
            $transaction = $transactionRepository->createTransaction($transactionData);
            if (! empty($transaction)) {
                $userData = [
                    'balance' => $transaction['current_balance'],
                    'id' => $userId,
                ];
                $this->dbm
                    ->executeQuery('UPDATE users SET balance=:balance WHERE id=:id', $userData);
            }

            return $this->findById($userId);
        }

        return null;
    }
}
