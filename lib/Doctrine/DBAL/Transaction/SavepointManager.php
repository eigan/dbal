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
interface SavepointManager
{
    /**
     * @param $savepoint
     *
     * @return Savepoint
     */
    public function createSavepoint($name);

    /**
     * @return Transaction
     */
    public function getTransaction();

    /**
     * @param Savepoint $savepoint
     */
    public function releaseSavepoint(Savepoint $savepoint);

    /**
     * @param Savepoint $savepoint
     */
    public function rollbackToSavepoint(Savepoint $savepoint);

    /**
     * @param $savepoint
     *
     * @return boolean
     */
    public function savepointExists($name);
}
