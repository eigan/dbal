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
class DefaultSavepointManager implements SavepointManager
{
    private $connection;

    private $platform;

    private $savepointFactory;

    /**
     * .
     *
     * @var \SplStack
     */
    private $savepointStack;

    private $transaction;

    public function __construct(Transaction $transaction, SavepointFactory $savepointFactory = null)
    {
        $this->savepointStack   = new \SplStack();
        $this->transaction      = $transaction;
        $this->savepointFactory = $savepointFactory ?: new DefaultSavepointFactory();
        $connection             = $transaction->getTransactionManager()->getConnection();
        $this->connection       = $connection->getWrappedConnection();
        $this->platform         = $connection->getDatabasePlatform();
    }

    /**
     * {@inheritdoc}
     */
    public function createSavepoint($name)
    {
        if ( ! $this->platform->supportsSavepoints()) {
            // throw NestedTransactionNotSupportedException
        }

        if ($this->savepointExists($name)) {
            // throw SavepointExistsException
        }

        $savepoint = $this->savepointFactory->createSavepoint($this, $name);

        $this->savepointStack->push($savepoint);

        return $savepoint;
    }

    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * {@inheritdoc}
     */
    public function releaseSavepoint(Savepoint $savepoint)
    {
        if ( ! $this->platform->supportsSavepoints()) {
            // throw NestedTransactionNotSupportedException
        }

        if ( ! $this->isManaged($savepoint)) {
            // throw SavepointNotManagedException
        }

        $savepoint->release();

        /** @var $currentSavepoint Savepoint */
        foreach ($this->savepointStack as $offset => $currentSavepoint) {
            if ($currentSavepoint === $savepoint) {
                $this->savepointStack->offsetUnset($offset);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rollbackToSavepoint(Savepoint $savepoint)
    {
        if ( ! $this->platform->supportsSavepoints()) {
            // throw NestedTransactionNotSupportedException
        }

        if ( ! $this->isManaged($savepoint)) {
            // throw SavepointNotManagedException
        }

        /** @var $currentSavepoint Savepoint */
        foreach ($this->savepointStack as $offset => $currentSavepoint) {
            if ($currentSavepoint !== $savepoint) {
                $currentSavepoint->rollback();
                $this->savepointStack->offsetUnset($offset);
                continue;
            }

            $currentSavepoint->rollback();

            return;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function savepointExists($name)
    {
        /** @var $savepoint Savepoint */
        foreach ($this->savepointStack as $savepoint) {
            // @todo Not sure to use strict comparison here.
            if ($savepoint->getName() === $name) {
                return true;
            }
        }

        return false;
    }

    private function isManaged(Savepoint $savepoint)
    {
        /** @var $currentSavepoint Savepoint */
        foreach ($this->savepointStack as $currentSavepoint) {
            if ($savepoint === $currentSavepoint) {
                return true;
            }
        }

        return false;
    }
}
