<?php

if (!\defined('CONSTANTS')) {
    // Error messages
    \define('MISSING_CONFIGURATION', '<b>Fatal Error:</b> Missing configuration details to connect to database');
    \define('CONFIGURATION_REQUIRES', '<b>Fatal Error:</b> This configuration requires ezsqlModel (ezsqlModel.php) to be included/loaded before it can be used');
    // ezQuery prepare placeholder/positional tag
    \define('_TAG', '__ez__');
    // Use to set get_result output as json 
    \define('_JSON', 'json');
 
    /**
    * Operator boolean expressions.
    */
    \define('EQ', '=');
    \define('NEQ', '<>');
    \define('NE', '!=');
    \define('LT', '<');
    \define('LTE', '<=');
    \define('GT', '>');
    \define('GTE', '>=');
    \define('_BOOLEAN', ['<', '>', '=', '!=', '>=', '<=', '<>']);
    
    \define('_IN', 'IN');
    \define('_notIN', 'NOT IN');
    \define('_LIKE', 'LIKE');
    \define('_notLIKE', 'NOT LIKE');
    \define('_BETWEEN', 'BETWEEN');
    \define('_notBETWEEN', 'NOT BETWEEN');
        
    \define('_isNULL', 'IS NULL');
    \define('_notNULL', 'IS NOT NULL');
    \define('_BOOLEAN_OPERATORS', ['<', '>', '=', '!=', '>=', '<=', '<>', 
        'IN', 'LIKE', 'NOT LIKE', 'BETWEEN', 'NOT BETWEEN', 'IS', 'IS NOT']);
    
    /**
    * Combine operators.
    */    
    \define('_AND', 'AND');
    \define('_OR', 'OR');
    \define('_NOT', 'NOT');
    \define('_andNOT', 'AND NOT');
    \define('_COMBINERS', ['AND', 'OR', 'NOT', 'AND NOT']);

    /*
    * for joining shortcut methods.
    */    
    \define('_INNER', 'INNER');
    \define('_LEFT', 'LEFT');
    \define('_RIGHT', 'RIGHT');
    \define('_FULL', 'FULL'); 
    \define('_JOINERS', ['INNER', 'LEFT', 'RIGHT', 'FULL']); 
 
    /**
    * Associative array of supported SQL Drivers, and library
    * @define(array)
    */
    \define('VENDOR', [
        'mysql' => 'ezsql\Database\ez_mysqli',
        'mysqli' => 'ezsql\Database\ez_mysqli',
        'pdo' => 'ezsql\Database\ez_pdo',
        'postgresql' => 'ezsql\Database\ez_pgsql',
        'pgsql' => 'ezsql\Database\ez_pgsql',
        'sqlite' => 'ezsql\Database\ez_sqlite3',
        'sqlite3' => 'ezsql\Database\ez_sqlite3',
        'sqlserver' => 'ezsql\Database\ez_sqlsrv',
        'mssql' => 'ezsql\Database\ez_sqlsrv',
        'sqlsrv' => 'ezsql\Database\ez_sqlsrv'
    ]);

    \define('MYSQL', 'mysqli', true);
    \define('MYSQLI', 'mysqli', true);
    \define('Pdo', 'pdo');
    \define('PGSQL', 'pgsql', true);
    \define('POSTGRESQL', 'pgsql', true);
    \define('SQLITE', 'sqlite3', true);
    \define('SQLITE3', 'sqlite3', true);
    \define('SQLSRV', 'sqlsrv');
    \define('SQLSERVER', 'sqlsrv', true);
    \define('MSSQL', 'sqlsrv', true);

    \define('ALLOWED_KEYS', [
        'host',
        'hostname',
        'user',
        'username',
        'password',
        'database',
        'db',
        'name',
        'dsn',
        'char',
        'charset',
        'path',
        'port',
        'file',
        'filebase',
        'tosql',
        'tomssql',
        'options'
    ]);
        
    \define('KEY_MAP', [
        'host' => 'host',
        'hostname' => 'host',
        'user' => 'user',
        'username' => 'user',
        'pass' => 'password',
        'password' => 'password',
        'database' => 'name',
        'db' => 'name',
        'name' => 'name',
        'dsn' => 'dsn',
        'char' => 'charset',
        'charset' => 'charset',
        'path' => 'path',
        'port' => 'port',
        'file' => 'isFile',
        'filebase' => 'isFile',
        'tosql' => 'toMssql',
        'tomssql' => 'toMssql',
        'options' => 'options'
    ]);

    // String SQL data types
    \define('CHAR', 'CHAR');
    \define('VARCHAR', 'VARCHAR');
    \define('CHARACTER', 'CHARACTER');
    \define('TEXT', 'TEXT');
    \define('TINY', 'TINYTEXT');
    \define('TINYTEXT', 'TINYTEXT');
    \define('MEDIUM', 'MEDIUMTEXT');
    \define('MEDIUMTEXT', 'MEDIUMTEXT');
    \define('LONGTEXT', 'LONGTEXT');
    \define('BINARY', 'BINARY');
    \define('VARBINARY', 'VARBINARY');
    \define('NCHAR', 'NCHAR');
    \define('NVAR', 'NVARCHAR');
    \define('NVARCHAR', 'NVARCHAR');
    \define('NTEXT', 'NTEXT');
    \define('IMAGE', 'IMAGE');
    \define('CLOB', 'CLOB');
        
    // Numeric SQL data types
    \define('INTR', 'INT');
    \define('INT0', 'INT');
    \define('INT2', 'INT2');
    \define('INT4', 'INT4');
    \define('INT8', 'INT8');
    \define('NUMERIC', 'NUMERIC');
    \define('DECIMAL', 'DECIMAL');
    \define('BIT', 'BIT');
    \define('VARBIT', 'VARBIT');
    \define('INTEGERS', 'INTEGER');
    \define('TINYINT', 'TINYINT');
    \define('SMALLINT', 'SMALLINT');
    \define('MEDIUMINT', 'MEDIUMINT');
    \define('BIGINT', 'BIGINT');
    \define('DEC', 'DEC');
    \define('FIXED', 'FIXED');
    \define('FLOATS', 'FLOAT');
    \define('DOUBLES', 'DOUBLE');
    \define('REALS', 'REAL');
    \define('BOOLS', 'BOOL');
    \define('BOOLEANS', 'BOOLEAN');
    \define('SMALLMONEY', 'SMALLMONEY');
    \define('MONEY', 'MONEY');
        
    // Date/Time SQL data types	
    \define('DATES', 'DATE');
    \define('TIMESTAMP', 'TIMESTAMP');
    \define('TIMES', 'TIME');
    \define('DATETIME', 'DATETIME');
    \define('YEAR', 'YEAR');
    \define('DATETIME2', 'DATETIME2');
    \define('SMALLDATETIME', 'SMALLDATETIME');
    \define('DATETIMEOFFSET', 'DATETIMEOFFSET');
        
    // Large Object SQL data types
    \define('TINYBLOB', 'TINYBLOB');
    \define('BLOB', 'BLOB');
    \define('MEDIUMBLOB', 'MEDIUMBLOB');
        
    \define('NULLS', 'NULL');
    \define('notNULL', 'NOT NULL');

    \define('CONSTRAINT', 'CONSTRAINT');
    \define('PRIMARY', 'PRIMARY KEY');
    \define('FOREIGN', 'FOREIGN KEY');
    \define('UNIQUE', 'UNIQUE');
    \define('INDEX', 'INDEX');
    \define('REFERENCES', 'REFERENCES');

    \define('AUTO', '__autoNumbers__');
    \define('SEQUENCE', '__autoNumbers__');
    \define('AUTO_INCREMENT', 'AUTO_INCREMENT');
    \define('AUTOINCREMENT', 'AUTOINCREMENT');
    \define('IDENTITY', 'IDENTITY');
    \define('SERIAL', 'SERIAL');
    \define('SMALLSERIAL', 'SMALLSERIAL');
    \define('BIGSERIAL', 'BIGSERIAL');

    \define('ADD', 'ADD');
    \define('DROP', 'DROP COLUMN');
    \define('CHANGE', 'CHANGE COLUMN');
    \define('ALTER', 'ALTER COLUMN');
    \define('MODIFY', 'MODIFY');
    \define('RENAME', 'RENAME TO');
    \define('CHANGER', '__modifyingColumns__');

    if (!\defined('_DS'))
        \define('_DS', \DIRECTORY_SEPARATOR);

    \define('CONSTANTS', true);
}
