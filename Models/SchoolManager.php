<?php
class SchoolManager
{
    public static function getAllSchools(): array
    {
        return Db::query("
            SELECT *
            FROM HU.skola");
    }

    public static function getSchoolByID(int $ID): array
    {
        return Db::query("
            SELECT *
            FROM HU.skola
            WHERE id = :id", array(
            ":id" => $id,
        ));
    }
}
