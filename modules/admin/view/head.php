<!DOCTYPE html>
<?php
    echo '<html lang="'.\Modules\Core\Modul\Head::$lang.'">';
    echo '<head>';
    echo '<meta charset="'.\Modules\Core\Modul\Head::$charset.'">';
    echo '<meta name="viewport" content="'.\Modules\Core\Modul\Head::$viewport.'">';
    echo '<title>'.\Modules\Core\Modul\Head::$title.'</title>';
    echo '<meta name="description" content="'.\Modules\Core\Modul\Head::$description.'">';
    echo '<link rel="icon" href="'.\Modules\Core\Modul\Head::$ico_href.'" type="'.\Modules\Core\Modul\Head::$ico_type.'">';
    echo '<meta name="theme-color" content="'.\Modules\Core\Modul\Head::$theme_color.'">';
    echo '<meta http-equiv="Content-Language" content="'.\Modules\Core\Modul\Head::$lang.'">';
    echo \Modules\Core\Modul\Resource::load_css();
    echo \Modules\Core\Modul\Resource::load_js();
?>

</head>