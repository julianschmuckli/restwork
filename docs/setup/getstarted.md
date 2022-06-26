# Get started

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

As you saw in the folder structure, there are some files, you have to manually create in your project. You can view them on [this page](./files.md).

Continue here with the [Usage](./usage.md).