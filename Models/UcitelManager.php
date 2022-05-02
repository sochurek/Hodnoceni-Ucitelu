<?php
class UcitelManager {
    public static function getAllUcitel(): array {
        return Db::query("
            SELECT *
            FROM HU.ucitel");
    }

    public static function getUcitelByID(int $ID): array {
        return Db::query("
            SELECT *
            FROM HU.ucitel
            WHERE id = :id", array(
                ":id" => $id,
            ));
    }
}