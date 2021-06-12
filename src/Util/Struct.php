<?php

namespace YouTrackAPI\Util;

class Struct
{
    public static function hasRequiredFields(?array $data, array $requiredFields): bool
    {
        if ($data === null) {
            return false;
        }

        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $data)) {
                return false;
            }
        }

        return true;
    }
}
