<?php
class Db
{

    // proměnné pro připojení k databázi
    private static $connection;
    private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    );

    // Metoda pro připojení k databázi
    public static function connect($host, $user, $password, $database)
    {
        if (!isset(self::$connection)) {
            self::$connection = @new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $password,
                self::$settings
            );
        }
    }

    // Metoda, která vytáhne všechny záznamy v databázi
    public static function query($query, $params = array())
    {
        $return = self::$connection->prepare($query);
        $return->execute($params);
        return $return->fetchAll();
    }

    // Metoda, která vytáhne pouze jeden záznam v databázi
    public static function singleQuery($query, $params = array())
    {
        $return = self::$connection->prepare($query);
        $return->execute($params);
        return $return->fetch();
    }
}
