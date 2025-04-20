<?php

namespace app\src\components\importer\enums;

use app\src\components\importer\builders\Builder;
use app\src\components\importer\builders\CityBuilder;

enum BuilderType
{
    case CITY;

    public function builder(): Builder
    {
        return match ($this) {
            self::CITY => new CityBuilder(),
        };
    }
}
