<?php


namespace models;


class Registration_from_literature extends \ActiveRecord\Model
{
    public static $table_name = 'registration_from_literature';

    public static $belongs_to = array(
        array('literature', 'foreign_key' => 'literature_id', 'class_name' => 'Literature')
    );
}