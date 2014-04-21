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
class DefaultTransactionFactory implements TransactionFactory
{
    public function createTransaction(TransactionManager $transactionManager, $name = null)
    {
        return new DefaultTransaction($transactionManager, $name = null);
    }
}
