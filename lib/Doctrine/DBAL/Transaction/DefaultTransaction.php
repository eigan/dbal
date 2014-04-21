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

/**
 * .
 *
 * @author Steve Müller <st.mueller@dzh-online.de>
 */
class DefaultTransaction implements Transaction
{
    private $status = Status::NOT_ACTIVE;

    /**
     * The transaction manager that manages this transaction.
     *
     * @var \Doctrine\DBAL\Transaction\TransactionManager
     */
    private $transactionManager;

    public function __construct(TransactionManager $transactionManager, $name = null)
    {
        $this->transactionManager = $transactionManager;
    }

    /**
     * {@inheritdoc}
     */
    public function begin()
    {
        $this->transactionManager->begin($this);
        $this->status = Status::ACTIVE;
    }

    public function commit()
    {
        $this->transactionManager->commit($this);
        $this->status = Status::COMMITTED;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function isActive()
    {
        return Status::ACTIVE === $this->status;
    }

    public function rollback()
    {
        $this->transactionManager->rollback($this);
        $this->status = Status::ROLLED_BACK;
    }

    public function wasCommitted()
    {
        return Status::COMMITTED === $this->status;
    }

    public function wasRolledBack()
    {
        return Status::ROLLED_BACK;
    }
}
