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
class DefaultSavepoint implements Savepoint
{
    private $connection;

    private $name;

    private $platform;

    private $savepointManager;

    private $status;

    public function __construct(SavepointManager $savepointManager, $name)
    {
        $this->savepointManager = $savepointManager;
        $this->name             = $name;
        $connection             = $savepointManager->getTransaction()->getTransactionManager()->getConnection();
        $this->connection       = $connection->getWrappedConnection();
        $this->platform         = $connection->getDatabasePlatform();
    }

    /**
     * {@inheritdoc}
     */
    public function begin()
    {
        if ( ! $this->platform->supportsSavepoints()) {
            // throw NestedTransactionNotSupportedException
        }

        if ( ! $this->connection->exec($this->platform->createSavePoint($this->name))) {
            // throw TransactionException
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getSavepointManager()
    {
        return $this->savepointManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function isActive()
    {
        return SavepointStatus::ACTIVE === $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function release()
    {
        if ( ! $this->isActive()) {
            // throw TransactionException
        }

        if ($this->platform->supportsReleaseSavepoints()) {
            $savepointReleased = (boolean) $this->connection->exec($this->platform->releaseSavePoint($this->getName()));

            if (false === $savepointReleased) {
                // throw TransactionException
            }
        }

        $this->status = SavepointStatus::RELEASED;
    }

    /**
     * {@inheritdoc}
     */
    public function rollback()
    {
        if ( ! $this->isActive()) {
            // throw TransactionException
        }

        $savepointRolledBack = (boolean) $this->connection->exec($this->platform->rollbackSavePoint($this->getName()));

        if (false === $savepointRolledBack) {
            // throw TransactionException
        }

        $this->status = SavepointStatus::ROLLED_BACK;
    }

    /**
     * {@inheritdoc}
     */
    public function wasReleased()
    {
        return SavepointStatus::RELEASED === $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function wasRolledBack()
    {
        return SavepointStatus::ROLLED_BACK === $this->status;
    }
}
