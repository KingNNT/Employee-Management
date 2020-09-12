<?php
class Redirect
{
    public static function back()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public static function url($to)
    {
        header('Location: ' . BASE_URL . $to);
    }
}
