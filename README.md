# CONTENTS OF THIS FILE

* About DDEV.
* How to add new site?

## About DDEV

DDEV is an open source tool that makes it simple to get local PHP development environments up and running in minutes.
This project is setup under the ddev. It is easy to manage our multisite setup under the ddev.

## How to add new site?

Currently we made an custom script that will automatically creates the new site.
Follow the below instructions:

* Navigate to sites directory and open the `sites.yml` file.

* Now you need to add site name under the sites. The site format should langcode: sitename.
  Example:

  ```yaml
  sites:
    fr: 'goal-fr'
    gb: 'goals-gb'
    in: 'goals-in'
    al: 'goals-al'
  ```

* Now you have to simply run the `ddev restart` command. We write and post script command that will automatically run the all script and created the new site.

* Now you have to navigate in `.ddev` directory and open the `config.multisite.yml` file.

* Now you need to add the hostname for the newly created site. Add the hostname under the `additional_hostnames` and save the file.
  Example:

  ```yaml
    additional_hostnames:
      - goal-fr
      - goals-gb
      - goals-in
      - goals-al
  ```

* Now run the `ddev restart` command. Once ddev started check the newly created domain. The Url of the domain like this `your-domain-name.ddev.site`.
