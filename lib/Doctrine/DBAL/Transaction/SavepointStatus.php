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
final class SavepointStatus
{
    const NOT_ACTIVE = 0;

    const ACTIVE = 1;

    const RELEASED = 2;

    const ROLLED_BACK = 3;

    private function __construct()
    {
    }
}
