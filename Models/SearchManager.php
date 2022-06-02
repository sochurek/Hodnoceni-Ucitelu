<?php

class SearchManager
{

    public static function getSearch($search): array
    {
        return Db::query(
            "
        SELECT *
        FROM HU.ucitel
        WHERE ucitel.jmeno like '%$search%'
        ORDER BY ucitel.jmeno DESC;"
        );
    }
}
