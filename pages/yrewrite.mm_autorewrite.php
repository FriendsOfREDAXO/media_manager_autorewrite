<?php

/**
 * media_manager_autorewrite Addon.
 *
 * @author Friends Of REDAXO
 *
 * @var rex_addon
 */
$content = '';
$addon = rex_addon::get('media_manager_autorewrite');

if (rex_post('config-submit', 'boolean')) {
    $addon->setConfig(rex_post('config', [
        ['replace_tags', 'string'],
        ['is_base_tag', 'boolean'],
        ['fix_expire_header', 'boolean'],
    ]));

    $content .= rex_view::info($addon->i18n('config_saved'));
}

$content .= '
<div class="rex-form">
<form action="'.rex_url::currentBackendPage().'" method="post">
<fieldset>';

$formElements = [];

// set tags
$formElements = [];
$elements = array();
$elements['label'] = '<label for="replace_tags">'.$addon->i18n('replace_tags').'</label>';
$elements['field'] = '<input class="form-control" type="text" id="replace_tags" name="config[replace_tags]" value="'.$addon->getConfig('replace_tags').'"/>';
$formElements[] = $elements;
// parse select element
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

// is base tag
$formElements = [];
$n = [];
$n['label'] = '<label for="is_base_tag">'.$addon->i18n('is_base_tag').'</label>';
$n['field'] = '<input type="checkbox" id="is_base_tag" name="config[is_base_tag]" value="1" '.($addon->getConfig('is_base_tag') ? ' checked="checked"' : '').' />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');

// is base tag
$formElements = [];
$n = [];
$n['label'] = '<label for="fix_expire_header">'.$addon->i18n('fix_expire_header').'</label>';
$n['field'] = '<input type="checkbox" id="fix_expire_header" name="config[fix_expire_header]" value="1" '.($addon->getConfig('fix_expire_header') ? ' checked="checked"' : '').' />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');

$content .= '
</fieldset>

<fieldset class="rex-form-action">';

$formElements = [];
$n = [];
$n['field'] = '<input class="btn btn-save rex-form-aligned" type="submit" name="config-submit" value="'.$addon->i18n('config_save').'" '.rex::getAccesskey($addon->i18n('config_save'), 'save').' />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/submit.php');

$content .= '
</fieldset>

</form>
</div>';

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title', $addon->i18n('config'));
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
