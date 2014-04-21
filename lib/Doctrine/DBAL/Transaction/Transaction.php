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
 * Contract for a logical unit of work (transaction) inside a database connection.
 *
 * Allows the application to define units of work, while maintaining abstraction from the underlying transaction
 * implementation.
 *
 * A transaction is associated with a {@link \Doctrine\DBAL\Connection} and can optionally be managed by a
 * {@link \Doctrine\DBAL\Transaction\TransactionManager} to be part of a logical transaction thread.
 *
 * @author Steve Müller <st.mueller@dzh-online.de>
 *
 * @since  2.5
 */
interface Transaction
{
    /**
     * Begins this transaction.
     *
     * No-op if the transaction has already been begun.
     *
     * @throws \Doctrine\DBAL\Transaction\TransactionException if there was a problem beginning this transaction.
     */
    public function begin();

    /**
     * Commits this transaction.
     *
     * @throws \Doctrine\DBAL\Transaction\TransactionException if there was a problem committing this transaction.
     */
    public function commit();

    /**
     * Returns the connection associated with this transaction.
     *
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection();

    /**
     * Returns the name of this transaction.
     *
     * Returns null in case this transaction is unnamed.
     *
     * @return string|null
     */
    public function getName();

    /**
     * Returns the current status of this transaction.
     *
     * This does not necessarily represent the actual status of the underlying transaction,
     * but instead answers on a best effort basis. This depends on the actual implementation
     * as some implementations might not be able to indicate the real status of the underlying
     * physical transaction.
     *
     * @return integer Bitwise flags defined in the \Doctrine\DBAL\Transaction\TransactionStatus constants.
     *
     * @see    \Doctrine\DBAL\Transaction\TransactionStatus
     */
    public function getStatus();

    /**
     * Returns the timeout set for this transaction.
     *
     * A negative value indicates no timeout has been set.
     *
     * @return integer The timeout in seconds.
     */
    public function getTimeout();

    /**
     * Checks whether this transaction is currently active.
     *
     * This does not necessarily represent the actual status of the underlying transaction,
     * but instead answers on a best effort basis. This depends on the actual implementation
     * as some implementations might not be able to indicate the real status of the underlying
     * physical transaction.
     *
     * @return boolean True if this transaction has been started and is active, false otherwise.
     */
    public function isActive();

    /**
     * Rolls this transaction back.
     *
     * Either rolls back the underlying transaction or ensures it cannot later commit
     * (depending on the actual underlying strategy).
     *
     * @throws \Doctrine\DBAL\Transaction\TransactionException if there was a problem rolling this transaction back.
     */
    public function rollback();

    /**
     * Checks whether this transaction has been committed.
     *
     * This does not necessarily represent the actual status of the underlying transaction,
     * but instead answers on a best effort basis. This depends on the actual implementation
     * as some implementations might not be able to indicate the real status of the underlying
     * physical transaction.
     *
     * @return boolean True if this transaction has been committed, false otherwise.
     */
    public function wasCommitted();

    /**
     * Checks whether this transaction has been rolled back.
     *
     * This does not necessarily represent the actual status of the underlying transaction,
     * but instead answers on a best effort basis. This depends on the actual implementation
     * as some implementations might not be able to indicate the real status of the underlying
     * physical transaction.
     *
     * @return boolean True if this transaction has been rolled back, false otherwise.
     */
    public function wasRolledBack();
}
