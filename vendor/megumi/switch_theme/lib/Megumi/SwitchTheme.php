<?php

if (!class_exists('Megumi_SwitchTheme')):

class Megumi_SwitchTheme {

private $name = null;
private $dir  = null;
private $url  = null;

/*
 * The constructor.
 *
 * @param string $name Slug of the theme.
 * @param string $dir  Absolute path to the themes directory.
 * @param string $uri  URI to the themes directory.
 */
function __construct($name, $dir = null, $uri = null)
{
    $this->name = $name;
    if ($dir) {
        $this->dir = $dir;
    } else {
        $this->dir = get_theme_root();
    }
    if ($uri) {
        $this->uri = $uri;
    } else {
        $this->uri = get_theme_root_uri();
    }
}

/*
 * Apply new theme.
 *
 * @param  none
 */
public function apply()
{
    add_filter("stylesheet", array($this, "template"));
    add_filter("template", array($this, "template"));
    add_filter("theme_root", array($this, "theme_root"));
    add_filter("theme_root_uri", array($this, "theme_root_uri"));
}

/*
 * Fire when template hook.
 *
 * @param  string $name Slug of the theme
 * @return string Customized theme slug.
 */
public function template($name)
{
    if ($this->name) {
        return $this->name;
    } else {
        return $name;
    }
}

/*
 * Fire when theme_root hook.
 *
 * @param  string $name Absolute path to the themes directory.
 * @return string Customized absolute path to the themes directory.
 */
public function theme_root($dir)
{
    if ($this->dir) {
        return $this->dir;
    } else {
        return $dir;
    }
}

/*
 * Fire when theme_root hook.
 *
 * @param  string $name Absolute URI to the themes directory.
 * @return string Customized absolute URI to the themes directory.
 */
public function theme_root_uri($uri)
{
    if ($this->uri) {
        return $this->uri;
    } else {
        return $uri;
    }
}

} // end class

endif;

// EOF
