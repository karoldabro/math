<?php

namespace Kdabrow\Math;

class Input
{
    /**
     * @param array $arguments
     * @param callable|null $itemCallback
     * @return array<int, Number>
     */
    public static function normalize(array $arguments, callable $itemCallback = null): array
    {
        $flattened = self::flattenArray($arguments);

        return is_null($itemCallback)
            ? $flattened
            : array_map($itemCallback, $flattened);
    }

    /**
     * Flatten an array of arguments
     *
     * @param array $arguments
     * @return array
     */
    private static function flattenArray(array $arguments): array
    {
        $result = [];

        foreach ($arguments as $item) {
            if (is_array($item)) {
                $result = array_merge($result, self::flattenArray($item));
                continue;
            }
            $result[] = $item;
        }

        return $result;
    }
}