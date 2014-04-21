<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\DBAL\Transaction;

/**
 * Enumeration type that represents the status a {@link Transaction} can be in.
 *
 * Implemented as bitwise integer flags so that a {@link Transaction} can both
 * be COMMITTED and FAILED_COMMIT.
 *
 * @author Steve Müller <st.mueller@dzh-online.de>
 *
 * @since  2.5
 */
final class TransactionStatus
{
    /**
     * The status flag that represents a transaction that has not yet been started.
     *
     * @var integer
     */
    const NOT_ACTIVE = 0;

    /**
     * The status flag that represents a transaction that has been started and is currently active.
     *
     * @var integer
     */
    const ACTIVE = 1;

    /**
     * The status flag that represents a transaction that has been committed.
     *
     * @var integer
     */
    const COMMITTED = 2;

    /**
     * The status flag that represents a transaction that has been rolled back.
     *
     * @var integer
     */
    const ROLLED_BACK = 4;

    /**
     * The status flag that represents a transaction that failed to commit.
     *
     * @var integer
     */
    const FAILED_COMMIT = 8;

    /**
     * Constructor.
     *
     * Private to avoid instantiation as this is a static enumeration type class.
     */
    private function __construct()
    {
    }
}
