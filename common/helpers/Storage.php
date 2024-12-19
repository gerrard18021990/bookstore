<?php

namespace common\helpers;

use Yii;

class Storage
{
    public function getPath(): bool|string
    {
        return Yii::getAlias('@frontend/web/assets/uploads/');
    }

    public function getWeb(): bool|string
    {
        return Yii::getAlias('@frontendUrl/assets/uploads/');
    }
}
