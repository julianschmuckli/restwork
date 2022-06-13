# RESTwork
RESTwork is a PHP framework to design a RESTful API service with minimum effort.

## Requirements
You need the following prerequisites to use RESTwork.
- PHP >= 8.0
- Composer

If you do not have the composer installed yet on macOS:
```bash
brew install composer
```
or download it directly via the website [getcomposer.org](https://getcomposer.org/)

## Installation
Create a new project and run the following command with the composer to install the "RESTwork".

```bash
composer require julianschmuckli/restwork
```

After the installation is completed, you should see the following structure:
```
- vendor/
    - julianschmuckli/
        - restwork/
            - docs/
            - src/
            - autoload.php
            ...
- composer.json
- composer.lock
```

Append the following folders and files to your root:
```diff
+ dao/
+ entites/
+ routes/
+ services/
  vendor/
+ .htaccess
+ autoload.php
  composer.json
  composer.lock
+ index.php
```

## Documentation
In the /docs folder, you can find the folder structure and their given roles in the framework.

## Example
You can find an example project here: [github.com/julianschmuckli/restwork_example](https://github.com/julianschmuckli/restwork_example)