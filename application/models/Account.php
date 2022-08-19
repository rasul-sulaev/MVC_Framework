<?php

namespace application\models;

use application\core\Model;

class Account extends Model {
    public function __construct() {
        echo "загузился Модель Account";
    }
}