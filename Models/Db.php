<?php

class Db {

    private static $conn;

    private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    );

    public static function connect($host, $user, $pw, $db) {
        if (!isset(self::$conn)) {
            self::$conn = @new PDO(
                "mysql:host=$host;dbname=$db",
                $user,
                $pw,
                self::$settings
            );
        }
    }

    public static function getOne($sql, $params = array()) {
        $item = self::$conn->prepare($sql);
        $item->execute($params);
		return $item->fetch();
	}

    public static function getAll($sql, $params = array()) {
        $item = self::$conn->prepare($sql);
        $item->execute($params);
		return $item->fetchAll();
	}

    public static function dotazSamotny($sql, $params = array()) {
        $item = self::getOne($sql, $params);
		return $item[0];
	}

	public static function ask($sql, $params = array()) {
		$item = self::$conn->prepare($sql);
        $item->execute($params);
		return $item->rowCount();
	}
    public static function insert($table, $params = array()) {
        return self::ask("INSERT INTO `$table` (`".
            implode('`, `', array_keys($params)).
            "`) VALUES (".str_repeat('?,', sizeOf($params)-1)."?)",
            array_values($params));
    }

    public static function change($table, $values = array(), $sql, $params = array())
    {
        return self::ask("UPDATE `$table` SET `".
            implode('` = ?, `', array_keys($values)).
            "` = ? " . $sql,
            array_merge(array_values($values), $params));
    }

}