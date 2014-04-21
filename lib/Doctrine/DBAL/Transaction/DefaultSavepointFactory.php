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
class DefaultSavepointFactory implements SavepointFactory
{
    /**
     * {@inheritdoc}
     */
    public function createSavepoint(SavepointManager $savepointManager, $savepoint)
    {
        return new DefaultSavepoint($savepointManager, $savepoint);
    }
}
