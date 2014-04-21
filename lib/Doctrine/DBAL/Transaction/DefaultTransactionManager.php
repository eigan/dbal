<?php

/*
 * This file is part of the DZH package.
 *
 * (c) DZH GmbH <projekte@dzh-online.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Doctrine\DBAL\Transaction;

use Doctrine\DBAL\Connection;

/**
 * .
 *
 * @author Steve Müller <st.mueller@dzh-online.de>
 */
class DefaultTransactionManager implements TransactionManager
{
    /**
     * The associated connection.
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    private $nestTransactionsWithSavepoints = false;

    private $rollbackOnly = false;

    /**
     * .
     *
     * @var TransactionFactory
     */
    private $transactionFactory;

    /**
     * .
     *
     * @var \SplStack
     */
    private $transactionStack;

    public function __construct(Connection $connection)
    {
        $this->connection         = $connection;
        $this->transactionFactory = $connection->getConfiguration()->getTransactionFactory();
        $this->transactionStack   = new \SplStack();
    }

    /**
     * {@inheritdoc}
     */
    public function attach(Transaction $transaction)
    {
        if ($this->isManaged($transaction)) {
            return;
        }

        if ($transaction->getConnection() !== $this->connection) {
            // throw TransactionException
        }

        if ($transaction->getStatus() !== TransactionStatus::NOT_ACTIVE) {
            // throw TransactionException
        }

        $this->transactionStack->push($transaction);
    }

    public function begin(Transaction $transaction)
    {
        if ($this->isManaged($transaction)) {
            return;
        }

        $transaction->begin();
    }

    public function commit(Transaction $transaction = null)
    {

    }

    public function createTransaction($name = null)
    {
        $transaction = $this->transactionFactory->createTransaction($this, $name);

        return $transaction;
    }

    public function getTransaction()
    {
        return $this->transactionStack->current();
    }

    public function getTransactionNestingLevel()
    {
        return $this->transactionStack->count();
    }

    public function nestTransactionsWithSavepoints($nestTransactionsWithSavepoints)
    {
        $this->nestTransactionsWithSavepoints = (boolean) $nestTransactionsWithSavepoints;
    }

    public function rollback(Transaction $transaction = null)
    {

    }

    public function setRollbackOnly()
    {
        $this->rollbackOnly = true;
    }

    public function shouldNestTransactionsWithSavepoints()
    {
        return $this->nestTransactionsWithSavepoints;
    }

    public function shouldRollbackOnly()
    {
        return $this->rollbackOnly;
    }

    public function reset()
    {
        $this->transactionStack = new \SplStack();
        $this->rollbackOnly = false;
    }

    private function isManaged(Transaction $transaction)
    {
        /** @var Transaction $currentTransaction */
        foreach ($this->transactionStack as $currentTransaction) {
            if ($transaction === $currentTransaction) {
                return true;
            }
        }

        return false;
    }
}
