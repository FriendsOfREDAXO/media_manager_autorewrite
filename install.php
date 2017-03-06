<?php
/**
 * User: joachimdoerr
 * Date: 12.02.17
 * Time: 14:48
 */

// set replace tags
$addon = rex_addon::get('media_manager_autorewrite');
if (!$addon->hasConfig()) {
    $addon->setConfig('replace_tags', 'src|href|data-highresmobile|data-highres|data-imagedefault');
    $addon->setConfig('is_base_tag', false);
    $addon->setConfig('fix_expire_header', false);
}
