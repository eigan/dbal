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
 * Contract for the definition of a {@link Transaction}.
 *
 * Defines the general behaviour and identity of a {@link Transaction}.
 *
 * @author Steve Müller <st.mueller@dzh-online.de>
 */
interface TransactionDefinition
{
    /**
     * Returns the isolation level the associated transaction runs in.
     *
     * @return integer One of the \Doctrine\DBAL\Transaction\IsolationLevel constants.
     */
    public function getIsolationLevel();

    /**
     * Returns the name of the associated transaction.
     *
     * Returns null in case the associated transaction is unnamed.
     *
     * @return string|null
     */
    public function getName();

    /**
     * Returns the propagation behaviour of the associated transaction.
     *
     *
     *
     * @return integer
     */
    public function getPropagationBehaviour();

    public function isReadOnly();
}
