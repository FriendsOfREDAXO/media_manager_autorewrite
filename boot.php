<?php

/**
 * media_manager_autorewrite Addon.
 *
 * @author Friends Of REDAXO
 *
 * @var rex_addon
 */

// Addonrechte (permissions) registieren
if (rex::isBackend() && is_object(rex::getUser())) {
    rex_perm::register('media_manager_autorewrite[]');
}

// bessere SEO urls für den image-manager
if (!rex::isBackend()) {
    $addon = rex_addon::get('media_manager_autorewrite');

    // expire fix für diverse server, welche media manager medien nicht über die htaccess beeinflussen können
    // thx @RexDude
    if ($addon->getConfig('fix_expire_header') && rex_get('rex_media_file') != '' && rex_get('rex_media_type') != '') {
        header('Cache-Control: max-age=604800'); // 1 week
        header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 604800));
    }

    // hier die tags definieren
    $replaceTags = $addon->getConfig('replace_tags'); // 'src|href|data-highresmobile|data-highres|data-imagedefault';
    $baseTag = $addon->getConfig('is_base_tag');

    /* credits to @jdlx for this awesome regular expression */
    rex_extension::register('OUTPUT_FILTER', function (rex_extension_point $ep) use ($replaceTags, $baseTag) {
        $regex = '/(?<='.$replaceTags.')(?:\s*=\s*")\.*\/*index.php\?(rex_media_file|rex_media_type)=([^&]+)&(?:amp;)*(rex_media_type|rex_media_file)=([^"&]+)/';
        $path = ($baseTag === true) ? '' : '/';

        $ep->setSubject(preg_replace_callback(
            $regex,
            function ($match) use ($ep, $path) {
                $rewrite = ($match[1] == 'rex_media_type' && $match[3] == 'rex_media_file')
                ? '="'.$path.'media/'.$match[2].'/'.$match[4]
                : '="'.$path.'media/'.$match[4].'/'.$match[2];

                return $rewrite;
            },
            $ep->getSubject())
        );

        $ep->setSubject( preg_replace('/(media\/[^&]+)&/', '$1?', $ep->getSubject()));
        
        return $ep->getSubject();
    });
}
