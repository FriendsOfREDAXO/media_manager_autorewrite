<?php

/** @var rex_addon $this */

$content = '';

if (rex_post('config-submit', 'boolean')) {
    $this->setConfig(rex_post('config', [
        ['replace_tags', 'string'],
        ['is_base_tag', 'boolean'],
    ]));

    $content .= rex_view::info($this->i18n('config_saved'));
}


$content .= '
<div class="rex-form">
    <form action="' . rex_url::currentBackendPage() . '" method="post">
        <fieldset>';

$formElements = [];

//$n = [];
//$n['label'] = '<label for="rex-demo_addon-config-url">' . $this->i18n('config_url') . '</label>';
//$n['field'] = '<input class="form-control" type="text" id="rex-demo_addon-config-url" name="config[url]" value="' . $this->getConfig('url') . '"/>';
//$formElements[] = $n;
//
//$n = [];
//$n['label'] = '<label for="rex-demo_addon-config-ids">' . $this->i18n('config_ids') . '</label>';
//$select = new rex_select();
//$select->setId('rex-demo_addon-config-ids');
//$select->setMultiple();
//$select->setAttribute('class', 'form-control');
//$select->setName('config[ids][]');
//for ($i = 1; $i < 6; ++$i) {
//    $select->addOption($i, $i);
//}
//$select->setSelected($this->getConfig('ids'));
//$n['field'] = $select->get();
//$formElements[] = $n;
//
//$fragment = new rex_fragment();
//$fragment->setVar('elements', $formElements, false);
//$content .= $fragment->parse('core/form/form.php');


// set tags
$formElements = [];
$elements = array();
$elements['label'] = '<label for="replace_tags">' . rex_i18n::msg('replace_tags') . '</label>';
$elements['field'] = '<input class="form-control" type="text" id="replace_tags" name="config[replace_tags]" value="' . $this->getConfig('replace_tags') . '"/>';
$formElements[] = $elements;
// parse select element
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

// is base tag
$formElements = [];
$n = [];
$n['label'] = '<label for="is_base_tag">' . $this->i18n('is_base_tag') . '</label>';
$n['field'] = '<input type="checkbox" id="is_base_tag" name="config[is_base_tag]" value="1" ' . ($this->getConfig('is_base_tag') ? ' checked="checked"' : '') . ' />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');


$content .= '
        </fieldset>

        <fieldset class="rex-form-action">';

$formElements = [];
$n = [];
$n['field'] = '<input class="btn btn-save rex-form-aligned" type="submit" name="config-submit" value="' . $this->i18n('config_save') . '" ' . rex::getAccesskey($this->i18n('config_save'), 'save') . ' />';
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
$fragment->setVar('title', $this->i18n('config'));
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
