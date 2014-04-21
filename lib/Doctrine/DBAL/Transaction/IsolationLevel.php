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
final class IsolationLevel
{
    const DEFAULT_ISOLATION = -1;

    /**
     * Constant for transaction isolation level READ UNCOMMITTED.
     */
    const READ_UNCOMMITTED = 1;

    /**
     * Constant for transaction isolation level READ COMMITTED.
     */
    const READ_COMMITTED = 2;

    /**
     * Constant for transaction isolation level REPEATABLE READ.
     */
    const REPEATABLE_READ = 3;

    /**
     * Constant for transaction isolation level SERIALIZABLE.
     */
    const SERIALIZABLE = 4;

    private function __construct()
    {
    }
}
