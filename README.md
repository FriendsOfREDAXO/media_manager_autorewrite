MM Autorewrite
========================

Dieses AddOn macht automatisch aus deinen Media Manager URLs schöne URLs (über den OUTPUT_FILTER).
Funktioniert für alle Attribute (src="index.php..", href="index.php...", jedoch nicht für srcset oder Background-Images). Die Attribute können eingestellt werden. Background images können manuell rewrited werden. (siehe unten)

> index.php?rex_media_type=ImgTypeName&rex_media_file=ImageFileName

wird zu

> images/mediatype/filename.jpg

Es wird automatisch innerhalb von src, href und data-highresmobile gesucht. Es können weitere auf der AddOn Page angegeben werden.

![Screenshot](https://raw.githubusercontent.com/FriendsOfREDAXO/media_manager_autorewrite/assets/screen.png)

Settingspage
------------
Die Settingspage integriert sich als Tab-Reiter innerhalb des AddOns yRewrite.

Installation
------------
Hinweis: dies ist kein Plugin!

* Release herunterladen und entpacken.
* Ordner umbenennen in `media_manager_autorewrite`.
* In den Addons-Ordner legen: `/redaxo/src/addons`.

Oder den REDAXO-Installer / ZIP-Upload AddOn nutzen!

Manuell
------------
Wenn du z.B. ein inline background-image rewriten willst, musst du das in deiner Ausgabe manuell machen. Anstatt den kompletten String anzugeben, kannst du auch einfach nur folgendes machen

```php
<?php
    echo mm_auto::rewrite('dateiname.jpg', 'imagetype');
    // Ausgabe: /images/imagetyp/dateiname.jpg (oder ../images/, abhängig von der BASE-Tag Einstellung)
?>
```

Voraussetzungen
------------

* yrewrite AddOn
* media_manager AddOn

Thanks
----
* Joachim Dörr für die Settingspage und Hilfe bei der Einrichtung
