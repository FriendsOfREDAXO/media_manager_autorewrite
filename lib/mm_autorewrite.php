<?php

/**
 * media_manager_autorewrite Addon.
 *
 * @author Friends Of REDAXO
 *
 * @var rex_addon
 */
class MM_auto
{
    public static function rewrite($filename = '', $type = '')
    {
        $addon = rex_addon::get('media_manager_autorewrite');
        $baseTag = $addon->getConfig('is_base_tag');
        $path = ($baseTag === true) ? '' : '/';

        $rewrite = $path.'images/'.$type.'/'.$filename;

        return $rewrite;
    }
}
