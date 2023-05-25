<?php
class JccbwebDeactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}