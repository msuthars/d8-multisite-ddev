#!/bin/bash
site_directory=$1
settings_default=$2
services_default=$3
settings=$4
services=$5
db_name=$6
drush_alias=$7
site_folder=$8
echo "Site is creating..."
mkdir -p -- $site_directory
cp $settings_default $settings
cp $services_default $services
mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS $db_name; GRANT ALL ON $db_name.* to 'db'@'%';"
drush cr
drush $drush_alias si --db-url=mysql://db:db@db/$db_name  --sites-subdir=$site_folder -y
echo "Site is created."
