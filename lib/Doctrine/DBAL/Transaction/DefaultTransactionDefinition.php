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
class DefaultTransactionDefinition implements TransactionDefinition
{
    private $isolationLevel;

    private $name;

    private $propagationBehaviour;

    private $readOnly;

    /**
     * Constructor.
     *
     * @param integer     $propagationBehaviour
     * @param integer     $isolationLevel
     * @param boolean     $readOnly
     * @param string|null $name
     */
    public function __construct(
        $propagationBehaviour = Propagation::NOT_SUPPORTED,
        $isolationLevel = IsolationLevel::DEFAULT_ISOLATION,
        $readOnly = false,
        $name = null
    ) {
        $this->propagationBehaviour = $propagationBehaviour;
        $this->isolationLevel       = $isolationLevel;
        $this->readOnly             = (boolean) $readOnly;
        $this->name                 = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getIsolationLevel()
    {
        return $this->isolationLevel;
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
    public function getPropagationBehaviour()
    {
        return $this->propagationBehaviour;
    }

    /**
     * {@inheritdoc}
     */
    public function isReadOnly()
    {
        return true === $this->readOnly;
    }

    /**
     * Sets the transaction isolation level to use.
     *
     * @param integer $isolationLevel One of the constant values of \Doctrine\DBAL\Transaction\IsolationLevel.
     */
    public function setIsolationLevel($isolationLevel)
    {
        $this->isolationLevel = $isolationLevel;
    }
}
