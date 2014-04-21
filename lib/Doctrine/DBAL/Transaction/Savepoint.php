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
interface Savepoint
{
    public function begin();

    public function getName();

    public function getSavepointManager();

    public function getStatus();

    public function isActive();

    public function release();

    public function rollback();

    public function wasReleased();

    public function wasRolledBack();
}
