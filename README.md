sfbase
=====

Ready to use Symfony 2.4 based template project, with latest common pre-configured bundles.

Includes css/js libraries:

- jQuery v1.11.0
- jQuery-ui v1.10.4
- typeahead.js v0.10.1
- TinyMCE v4.0.21
- Hogan.js v2.0.0
- Bootstrap v3.1.1

Includes Symfony 2 general bundles:

- DoctrineFixturesBundle
- StofDoctrineExtensionsBundle
- FOSUserBundle
- KnpMenuBundle
- BCCCronManagerBundle

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
===
- profiler has been disabled
- emails on dev environment will be spooled to disk
- console, app.php, app_dev.php have enabled umask(0000) for simplified permissions workaround
- log files will rotate on daily bases
- by default, only two languages are added and fully translated: English and Lithuanian, but any language can be easily added by editing translation files and only topMenu

Installation
===

1. **Composer packages**

        php composer.phar install

    You will be prompted to enter configuration values in parameters.yml, please refere to [parameters.yml.dist](/app/config/parameters.yml.dist) for more information.

2. **Create database and schema**

        php app/console doctrine:database:create
        php app/console doctrine:schema:create

3. **Add user to the system**

        php app/console fos:user:create

    To add administrative role to user, execute following command, and enter **ROLE_ADMIN** role when prompted.

        php app/console fos:user:promote

