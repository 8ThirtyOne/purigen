<?php


namespace models;


class Registration_events extends \ActiveRecord\Model
{
    public static $belongs_to = array(
        array('events', 'foreign_key' => 'event_id', 'class_name' => 'Events')
    );
}