<?php
/**
 * User: joachimdoerr
 * Date: 12.02.17
 * Time: 14:48
 */

// set replace tags
if (!$this->hasConfig()) {
    $this->setConfig('replace_tags', 'src|href|data-highresmobile|data-highres|data-imagedefault');
    $this->setConfig('is_base_tag', false);
}
