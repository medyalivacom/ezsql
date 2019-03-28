<?php
declare(strict_types=1);

namespace ezsql;

use Exception;
use ezsql\ConfigAbstract;
use ezsql\ConfigInterface;

/**
* @method void setDriver($args);
* @method void setDsn($args);
* @method void setUser($args);
* @method void setPassword($args);
* @method void setName($args);
* @method void setHost($args);
* @method void setPort($args); 
* @method void setCharset($args);
* @method void setOptions($args);
* @method void setIsFile($args);
* @method void setToMysql($args);
* @method void setPath($args);
*
* @method string getDriver();
* @method string getDsn();
* @method string getUser();
* @method string getPassword()
* @method string getName();
* @method string getHost();
* @method string getPort();
* @method string getCharset();
* @method string getOptions();
* @method bool getIsFile();
* @method bool getToMysql();
* @method string getPath();
*/
class Config extends ConfigAbstract implements ConfigInterface
{
    public function __construct(string $driver = '', $arguments = null)
    {
        $sql = \strtolower($driver);
        if (!\array_key_exists($sql, \VENDOR) || empty($arguments)) {
            throw new Exception(\MISSING_CONFIGURATION);
        } else {
            $this->setDriver($sql);
            if ($sql == \Pdo) {
                $this->setupPdo($arguments);            
            } elseif (($sql == \POSTGRESQL) || ($sql == \PGSQL)) {
                $this->setupPgsql($arguments);
            } elseif (($sql == \SQLSRV) || ($sql == \MSSQL) || ($sql == \SQLSERVER)) {
                $this->setupSqlsrv($arguments);
            } elseif (($sql == \MYSQLI) || ($sql == \MYSQL)) {
                $this->setupMysqli($arguments);
            } elseif (($sql == \SQLITE3) || ($sql == \SQLITE)) {
                $this->setupSqlite3($arguments);
            }
        }
    }

    /**
     * Setup Connections for each SQL database class
     * @param string $driver - The vendor's SQL database driver name
     * @param string|array $arguments In the following:
     * 
     * - user|args[0][1] // The database user name
     * - password|args[1][2] // The database users password
     * - database|args[1][2] // The name of the database
     * - host|args[3] // The host name or IP address of the database server,
     *      Default is localhost
     * - port|args[4] // The  database TCP/IP port, 
     *      Default is: 5432 - PostgreSQL, 3306 - MySQL
     * 
     *  for: mysqli 
     * - (username, password, database, host, port, charset)
     * - charset|args[5] // The database charset, 
     *      Default is empty string
     * 
     *  for: postgresql  
     * - (username, password, database, host, port)
     * 
     *  for: sqlserver 
     * - (username, password, database, host, convertMysqlToMssqlQuery)
     * - convertMysqlToMssqlQuery[4] // convert Queries in MySql syntax to MS-SQL syntax
     *      Default is false
     * 
     *  for: pdo
     * - (dsn, username, password, options, isFile?) 
     * - dsn |args[0] // The PDO DSN connection parameter string
     * - options|args[3] // Array for setting connection options as MySQL
     * - isFile|args[4] // File based databases like SQLite don't need
     *      user and password, they work with path in the dsn parameter
     *      Default is false
     * 
     *  for: sqlite3 
     * - (filePath, database) - filePath|args[0] // The path to open an SQLite database
     */
    public static function initialize(string $driver = '', $arguments = null)
    {
        return new self($driver, $arguments);
    }

    private function setupMysqli($args) 
    {
        if ( ! \function_exists ('mysqli_connect') ) 
            throw new Exception('<b>Fatal Error:</b> ez_mysql requires mySQLi Lib to be compiled and or linked in to the PHP engine');
        elseif (\is_string($args))
            $this->parseConnectionString($args, ['user', 'name', 'password']);
        elseif (\count($args)>=3) {
            $this->setUser($args[0]);
            $this->setPassword($args[1]);
            $this->setName($args[2]);
            $this->setHost(empty($args[3]) ? $this->getHost() : $args[3]);
            $this->setPort(empty($args[4]) ? '3306' : $args[4]);
            $charset = !empty($args[5]) ? $args[5] : '';
            $this->setCharset(empty($charset) ? $this->getCharset() : \strtolower(\str_replace('-', '', $charset)));
        } else
            throw new Exception(\MISSING_CONFIGURATION);
    }

    private function setupPdo($args) 
    {
        if ( ! \class_exists ('PDO') )
            throw new Exception('<b>Fatal Error:</b> ez_pdo requires PDO Lib to be compiled and or linked in to the PHP engine');           
        elseif (\is_string($args))
            $this->parseConnectionString($args, ['dsn', 'user', 'password']);
        elseif (\count($args)>=3) {
            $this->setDsn($args[0]);
            $this->setUser($args[1]);
            $this->setPassword($args[2]);
            $this->setOptions(empty($args[3]) ? $this->getOptions() : $args[3]);
            $this->setIsFile(empty($args[4]) ? $this->getIsFile() : $args[4]);
        } else
           throw new Exception(\MISSING_CONFIGURATION);
    }

    private function setupSqlsrv($args) 
    {
        if ( ! \function_exists ('sqlsrv_connect') ) 
            throw new Exception('<b>Fatal Error:</b> ez_sqlsrv requires the php_sqlsrv.dll or php_pdo_sqlsrv.dll to be installed. Also enable MS-SQL extension in PHP.ini file ');
        elseif (\is_string($args))
            $this->parseConnectionString($args, ['user', 'password', 'name']);
        elseif (\count($args)>=3) {
            $this->setUser($args[0]);
            $this->setPassword($args[1]);
            $this->setName($args[2]);
            $this->setHost(empty($args[3]) ? $this->getHost() : $args[3]);
            $this->setToMssql(empty($args[4]) ? $this->getToMssql() : $args[4]);
        } else
            throw new Exception(\MISSING_CONFIGURATION);
    }

    private function setupPgsql($args) 
    {
        if ( ! \function_exists ('pg_connect') )
            throw new Exception('<b>Fatal Error:</b> ez_pgsql requires PostgreSQL Lib to be compiled and or linked in to the PHP engine');
        elseif (\is_string($args))
            $this->parseConnectionString($args, ['user', 'password', 'name']);
        elseif (count($args)>=3) {
            $this->setUser($args[0]);
            $this->setPassword($args[1]);
            $this->setName($args[2]);
            $this->setHost(empty($args[3]) ? $this->getHost() : $args[3]);
            $this->setPort(empty($args[4]) ? '5432' : $args[4]);
        } else
            throw new Exception(\MISSING_CONFIGURATION);
    }

    private function setupSqlite3($args) {
        if ( ! \class_exists ('SQLite3') ) 
            throw new Exception('<b>Fatal Error:</b> ez_sqlite3 requires SQLite3 Lib to be compiled and or linked in to the PHP engine');
        elseif (\is_string($args))
            $this->parseConnectionString($args, ['path', 'name']);
        elseif (\count($args)==2) {
            $this->setPath($args[0]);
            $this->setName($args[1]);
        } else
            throw new Exception(\MISSING_CONFIGURATION);
    }

    /**
    * @param string $connectionString
    * @throws Exception If vendor specifics not provided.
    */
    private function parseConnectionString(string $connectionString, array $check_for) 
    {
        $params = \explode(";", $connectionString);

        if (\count($params) === 1) { // Attempt to explode on a space if no ';' are found.
            $params = \explode(" ", $connectionString);
        }

        foreach ($params as $param) {
            list($key, $value) = \array_map("trim", \explode("=", $param, 2) + [1 => null]);

            if (isset(\KEY_MAP[$key])) {
                $key = \KEY_MAP[$key];
            }

            if (!in_array($key, \ALLOWED_KEYS, true)) {
                throw new Exception("Invalid key in connection string: " . $key);
            }

            $this->{$key} = $value;
        }

        foreach ($check_for as $must_have) {
            if(!isset($this->{$must_have}))
                throw new Exception("Required parameters ".$must_have." need to be passed in connection string");
        }

        return true;
    }
}