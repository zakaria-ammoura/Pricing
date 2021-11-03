<?php

namespace App\Utils;

use App\Exception\DataException;

/**
 * Class StateHelper
 */
class StateHelper
{
    const AVERAGE = 'etat moyen';
    const GOOD = 'bon état';
    const VERY_GOOD = 'très bon état';
    const NEW = 'neuf';
    const LIKE_NEW = 'comme neuf';

    const STATUS_VALUES = [
        self::AVERAGE => 1,
        self::GOOD => 2,
        self::VERY_GOOD => 3,
        self::LIKE_NEW => 4,
        self::NEW => 5
    ];

    /**
     * @param array $articles
     *
     * @return array
     */
    public static function convertObjectToValue(array $articles)
    {
        $array = [];
        foreach ($articles as $article) {
            $array[self::STATUS_VALUES[strtolower($article['state'])]] = $article['price'];
        }

        return $array;
    }

    /**
     * @param string $status
     *
     * @return int
     *
     * @throws DataException
     */
    public static function getStatusId(string $status): int
    {
        $status = strtolower($status);
        if (!in_array($status, array_keys(self::STATUS_VALUES))){
            throw new DataException(
                "Invalid status given ($status)!"
            );
        }

        return self::STATUS_VALUES[$status];
    }

    /**
     * @param array $data
     * @param int  $state
     *
     * @return int|null
     */
    public static function getNearestStatus(array $data, int $state): ?int
    {
        $ids = array_keys($data);

        foreach ($ids as $i) {
            $smallest[$i] = abs($i - $state);
        }
        asort($smallest);
        $nearestStatus = key($smallest);

        foreach ($data as $key => $value) {
            if ($nearestStatus < $key && $data[$nearestStatus] > $value) {
                $nearestStatus = $key;
            }
        }

        return $nearestStatus;
    }

}