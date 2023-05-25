<?php
class JccbwebActivate
{
    public static function activate() {
        flush_rewrite_rules();
    }
}