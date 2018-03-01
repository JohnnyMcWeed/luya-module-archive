# Archive Module
 
The archive module gives the possibility to add an object archive to a Luya application. Therefore articles can be added in the backend, which get shown on the frontend afterwards.
 
## Installation

For the installation of modules Composer is required.

```sh
composer require johnnymcweed/luya-module-archive:dev-master 
```

### Configuration

```php
return [
    'modules' => [
        // ...
        'archive' => 'johnnymcweed\archive\frontend\Module',
        'archiveadmin' => 'johnnymcweed\archive\admin\Module',
        // ...
    ],
];
```

### Initialization 

After successfully installation and configuration run the migrate, import and setup command to initialize the module in your project.

1.) Migrate your database.

```sh
./vendor/bin/luya migrate
```

2.) Import the module and migrations into your LUYA project.

```sh
./vendor/bin/luya import
```

After adding the persmissions to your group you will be able to edit and add new news articles.

## Example Views

There are default views set up. Use these or create your own custom views.
