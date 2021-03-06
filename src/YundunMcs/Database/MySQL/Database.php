<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Database\MySQL;

use PDO;
use YundunMcs\Util\Arr;
use YundunMcs\Util\Validator;
use InvalidArgumentException;
use YundunMcs\Database\MySQL\Foundation\Util;

class Database
{
    /**
     * The SQL statement actuator.
     *
     * @var YundunMcs\Database\MySQL\Actuator
     */
    protected $actuator;

    /**
     * The transaction manager.
     *
     * @var YundunMcs\Database\MySQL\Transaction
     */
    protected $transaction;

    /**
     * The database name.
     *
     * @var string
     */
    protected $name;

    /**
     * The current database table names.
     *
     * @var null|array
     */
    protected $tables = null;

    /**
     * The database constructor.
     *
     * @param YundunMcs\Database\MySQL\Actuator $actuator The SQL statement actuator.
     * @param string                         $name     The database name.
     *
     * @throws InvalidArgumentException Thrown when the database name can not be determined.
     *
     * @return void
     */
    public function __construct(Actuator $actuator, string $name = '')
    {
        $this->actuator    = $actuator;
        $this->transaction = new Transaction($actuator->getConnection());
        $this->name        = $this->formatDatabaseName($name);
    }

    /**
     * Format the database name.
     *
     * @param string $name The database name.
     *
     * @return string
     */
    protected function formatDatabaseName(string $name): string
    {
        if (Validator::isNotEmptyString($name)) {
            return $name;
        }

        // Get the actuator bound connection, maybe we will use it multiple times.
        $connection = $this->getActuator()->getConnection();

        // If the default database name is empty, automatically try to get the database name
        // from the server configuration.
        $name = $connection->getServer()->getDatabaseName();

        if (Validator::isNotEmptyString($name)) {
            return $name;
        }

        // If we can not get the default database name from the server configuration and
        // the database is already connected, we will automatically try to query
        // the default database name used by the current connection.
        if ($connection->isConnected()) {
            $name = $this->getDatabaseNameFromConnection();

            if (Validator::isNotEmptyString($name)) {
                return $name;
            }
        }

        // We really can not determine the database name.
        throw new InvalidArgumentException('Unable to determine the database name.');
    }

    /**
     * Get the current default database name.
     *
     * @return string
     */
    public function getDatabaseName(): string
    {
        return $this->name;
    }

    /**
     * Get the current wrapped default database name.
     *
     * @return string
     */
    public function getWrappedDatabaseName(): string
    {
        return Util::wrap($this->getDatabaseName());
    }

    /**
     * Get the current SQL statement actuator.
     *
     * @return YundunMcs\Database\MySQL\Actuator
     */
    public function getActuator(): Actuator
    {
        return $this->actuator;
    }

    /**
     * Get the database name from the current connection.
     *
     * @return string
     */
    public function getDatabaseNameFromConnection(): string
    {
        $row = $this->getActuator()->query('SELECT DATABASE()')->fetch(PDO::FETCH_NUM);

        return (string) Arr::first($row);
    }

    /**
     * Use the given database name as the default database name for the current connection.
     *
     * @param string $name The given database name.
     *
     * @return self
     */
    public function useDatabaseName(string $name = ''): self
    {
        // If no given database name, then automatically use the current database name.
        if ('' === $name) {
            $name = $this->getDatabaseName();
        }

        $this->getActuator()->execute('USE '.Util::wrap($name));

        return $this;
    }

    /**
     * Get the current database table names.
     *
     * @param bool $noCache Do not read cached data.
     *
     * @return array
     */
    public function getDatabaseTables(bool $noCache = false): array
    {
        if (is_null($this->tables) || $noCache) {
            $this->tables = $this
                ->getActuator()
                ->query('SHOW TABLES FROM '.$this->getWrappedDatabaseName())
                ->fetchAll(PDO::FETCH_FUNC, function ($table) {
                    return $table;
                });
        }

        return $this->tables;
    }

    /**
     * Get the current transaction manager.
     *
     * @return YundunMcs\Database\MySQL\Transaction
     */
    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }
}
