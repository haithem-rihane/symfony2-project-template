symfony2 project template
=========================

[![Build Status](https://travis-ci.org/trylika/symfony2-project-template.svg)](https://travis-ci.org/trylika/symfony2-project-template)

Ready to use Symfony 2.6 based template project, with latest common pre-configured bundles and jQuery, Bootstrap and other usefull plugins.

Includes css/js libraries:

- jQuery ~2.1.3
- jQuery-ui ~1.11.2
- typeahead.js ~0.10.5
- TinyMCE ~4.1.7
- Hogan.js ~3.0.2
- Bootstrap ~3.3.2
- Jasny Bootstrap ~3.1.3
- Bootstrap social ~4.8.0
- Font Awesome ~4.2.0

Includes Symfony 2 general bundles:

- DoctrineFixturesBundle
- StofDoctrineExtensionsBundle
- FOSUserBundle
- KnpMenuBundle
- BCCCronManagerBundle
- LiipImagineBundle
- LiipFunctionalTestBundle
- fzaninotto/Faker
- IphpFileStoreBundle

Includes Symfony 2 data view related bundles:

- APYDataGridBundle
- KnpPaginatorBundle

Includes Symfony 2 JS related bundles:

- FOSJsRoutingBundle
- BazingaJsTranslationBundle

Includes Symfony 2 REST related bundles:

- FOSRestBundle
- JMSSerializerBundle
- NelmioApiDocBundle

Other important changes
=======================
- ongr-io/ongr-strict-standard has been used to verify code quality
- profiler has been disabled
- emails on dev environment will be spooled to disk
- console, app.php, app_dev.php have enabled umask(0000) for simplified permissions workaround
- log files will rotate on daily bases
- by default, only two languages are added and fully translated: English and Lithuanian, but any language can be easily added by editing translation files and only topMenu

Installation
============

1. **Composer packages**

        php composer.phar install

    You will be prompted to enter configuration values in parameters.yml, please refer to [parameters.yml.dist](/app/config/parameters.yml.dist) for more information.

2. **JS/CSS packages**

        bower install

3. **Create database and schema**

        php app/console doctrine:database:create
        php app/console doctrine:schema:create

4. **Add user to the system**

        php app/console fos:user:create

    To add administrative role to user, execute following command, and enter **ROLE_ADMIN** role when prompted.

        php app/console fos:user:promote
