<?php
 namespace Echyzen;
  
use PDOStatement;

/**
 * Adds PDO methods to the application.
 *
 */
trait DataBaseTrait
{
    /**
     * Creates a new prepared statement.
     *
     * @param string $statement The statement.
     * @param array  $options   The driver options.
     *
     * @return PDOStatement The new statement.
     */
    public function prepare($statement, array $options = array())
    {
        return $this['pdo']->prepare($statement, $options);
    }
}