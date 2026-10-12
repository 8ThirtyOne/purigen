<?php
namespace models;

class Literature extends \ActiveRecord\Model
{
    public const REGISTRATION_ENABLE = 1;
    public const REGISTRATION_DISABLE = 0;

    public static $table_name = 'literature';
}
?>