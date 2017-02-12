<?php

/**
 * media_manager_autorewrite Addon.
 *
 * @author Friends Of REDAXO
 *
 * @var rex_addon
 */

echo rex_view::title($this->i18n('title'));

$subpage = rex_be_controller::getCurrentPagePart(2);

include rex_be_controller::getCurrentPageObject()->getSubPath();
