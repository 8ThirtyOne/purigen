<?php


namespace models;


class Registration_from_video extends \ActiveRecord\Model
{
    public static $table_name = 'registration_from_video';

    public static $belongs_to = array(
        array('video', 'foreign_key' => 'video_id', 'class_name' => 'Video')
    );
}