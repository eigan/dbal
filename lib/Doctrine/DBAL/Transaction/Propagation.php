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
final class Propagation
{
    const NOT_SUPPORTED = 0;

    const SUPPORTS = 1;

    const REQUIRED = 2;

    const REQUIRES_NEW = 3;

    const MANDATORY = 4;

    const NESTED = 5;

    public function __construct();
}
