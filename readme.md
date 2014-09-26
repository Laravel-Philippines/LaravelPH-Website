## Laravel Philippines Website

[![Build Status](https://travis-ci.org/Laravel-Philippines/LaravelPH-Website.svg?branch=master)](https://travis-ci.org/Laravel-Philippines/LaravelPH-Website)

Facebook Group - https://www.facebook.com/groups/laravelph

Twitter Account - https://twitter.com/LaravelPH

### How to give suggestions?
Create an issue - [https://github.com/Laravel-Philippines/LaravelPH-Website/issues](https://github.com/Laravel-Philippines/LaravelPH-Website/issues).

### How to contribute?
Please read through our [contributing guidelines](https://github.com/Laravel-Philippines/LaravelPH-Website/blob/master/CONTRIBUTING.md).

### Local installation
Here are the steps for installation on a local machine.

1. Make sure you have [Laravel Homestead](http://laravel.com/docs/homestead) installed.
2. Clone this repository.

    ```
    git clone git@github.com:Laravel-Philippines/LaravelPH-Website.git laravelph/
    cd laravelph/
    ```

3. Add the path for the cloned laravelph repository to the `Homestead.yml` file under the `folders` list.
4. Add a site `laravelph.local` for the laravelph repository to the `Homestead.yml` file under the `sites` list.
5. Run `vagrant provision` in your Homestead folder.
6. Create a database in Homestead called `laravelph`.
7. Create a file named .env.local.php in the root folder of laravelph repository and copy and paste the code below:

    ```php
    <?php

    return array(

        'DB_HOST' => 'localhost',
        'DB_NAME' => 'laravelph',
        'DB_USERNAME' => 'homestead',
        'DB_PASSWORD' => 'secret',

    );
    ```

8. Add `127.0.0.1 laravelph.local` to your computer's `hosts` file.

You can now visit the app in your browser by visiting [http://laravelph.local:8000/](http://laravelph.local:8000).

### Running the tests

1. Create a database in Homestead called `laravelph_test`
2. SSH into your Homestead box, go to the laravelph folder and run `./vendor/bin/phpunit`