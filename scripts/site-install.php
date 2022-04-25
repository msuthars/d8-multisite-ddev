<?php

/**
 * @file
 * The Drupal installation script.
 */

require_once '../autoload.php';

use Symfony\Component\Yaml\Yaml;

$sites = Yaml::parseFile('../sites/sites.yml');
$setting_default = '../sites/default/default.settings.php';
$services_default = '../sites/default/default.services.yml';
foreach ($sites['sites'] as $site) {
  $site_dir = '../sites/' . $site;
  $site_folder = $site;
  $setting = $site_dir . '/settings.php';
  $services = $site_dir . '/services.yml';
  $db_name = str_replace('-', '_', $site);
  $drush_alias = '@' . $site . '.ddev';
  $alias_array = [
    'ddev' => [
      'root' => '/var/www/html/sites/' . $site,
      'uri' => 'https://' . $site . '.ddev.site',
    ],
  ];
  $alias_file = Yaml::dump($alias_array);
  $site_entry = "\n\$sites['$site.ddev.site'] = '$site';";
  if (file_exists($site_dir)) {
    if (!is_dir($site_dir)) {
      file_put_contents('../drush/sites/' . $site . '.site.yml', $alias_file);
      file_put_contents('../sites/sites.php', $site_entry . PHP_EOL, FILE_APPEND | LOCK_EX);
      echo shell_exec("sh site-install.sh $site_dir $setting_default $services_default $setting $services $db_name $drush_alias $site_folder");
    }
    else {
      echo 'Site already exists. ';
    }
  }
  else {
    file_put_contents('../drush/sites/' . $site . '.site.yml', $alias_file);
    file_put_contents('../sites/sites.php', $site_entry . PHP_EOL, FILE_APPEND | LOCK_EX);
    echo shell_exec("sh site-install.sh $site_dir $setting_default $services_default $setting $services $db_name $drush_alias $site_folder");
  }
}
