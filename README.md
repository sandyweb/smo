# Smoook web application

Specify Mysql credentials in file  ``application/config/database.php``

    ['default']['connection']['hostname'] = '';
    ['default']['default']['username'] = '';
    ['default']['default']['password'] = '';
    ['default']['default']['database'] = '';

    ['alternate']['connection']['dsn'] = '';
    ['alternate']['connection']['username'] = '';
    ['alternate']['connection']['password'] = '';

Specify base url in file ``application/bootstrap.php``

    Kohana::init('base_url') = '';

Specify 2checkout credentials in ``application/config/config.php``

Auto deployment settings specified in ``deploy.php``. [Github Repository][1]

[1]: https://github.com/markomarkovic/simple-php-git-deploy