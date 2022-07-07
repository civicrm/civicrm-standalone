# CiviCRM (Standalone)

This is the development repository for [CiviCRM Standalone](https://lab.civicrm.org/dev/core/-/wikis/standalone). It aims to provide a version of [CiviCRM](https://civicrm.org) that does not require a content management system (CMS), such as WordPress or Drupal.

It is still in the early development stages. Eventually we aim to provide a zip/tar archive that can be uploaded to a web server. Currently it requires [composer](https://getcomposer.org/) or [buildkit](), which are fairly technical tools used mostly by (respectively) PHP and CiviCRM developers.

## Installation

Using composer:

```
cd /var/www/
git clone https://github.com/civicrm/civicrm-standalone standalone
cd standalone
composer install
```

and then change some permissions:

```
cd /var/www/standalone

# Smarty cache and logs are stored outside the public webroot (unlike typical installs with a CMS)
# Allow the webserver to write in this directory
chgrp www-data data
chmod g+w data

# Publicly accessible files (ex: upload/ext, upload/persist)
chgrp www-data web/upload
chmod g+w web/upload
```

Alternatively, using [CiviCRM buildkit](https://github.com/civicrm/civicrm-buildkit/):

```
civibuild create mytest1 --type standalone-clean --civi-ver master
```

## Development

We are using CiviCRM's Gitlab for issues/discussion, and Github pull-requests for tracking code changes.

* CiviCRM Standalone meta-issue: https://lab.civicrm.org/dev/core/-/issues/2998
* CiviCRM Standalone github repo: https://github.com/civicrm/civicrm-standalone

We also have a [CiviCRM Standalone channel](https://chat.civicrm.org/civicrm/channels/standalone) on CiviCRM's chat.

## About CiviCRM

CiviCRM is web-based, open source, Constituent Relationship Management (CRM) software geared toward meeting the needs of non-profit and other civic-sector organizations.

As a non profit committed to the public good itself, CiviCRM understands that forging and growing strong relationships with constituents is about more than collecting and tracking constituent data - it is about sustaining relationships with supporters over time.

To this end, CiviCRM has created a robust web-based, open source, highly customizable, CRM to meet organizations’ highest expectations right out-of-the box. Each new release of this open source software reflects the very real needs of its users as enhancements are continually given back to the community.

With CiviCRM's robust feature set, organizations can further their mission through contact management, fundraising, event management, member management, mass e-mail marketing, peer-to-peer campaigns, case management, and much more.

CiviCRM is localized in over 20 languages including: Chinese (Taiwan, China), Dutch, English (Australia, Canada, U.S., UK), French (France, Canada), German, Italian, Japanese, Russian, and Swedish.

For more information, visit the [CiviCRM website](https://civicrm.org).
