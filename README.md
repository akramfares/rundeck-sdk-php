# rundeck-sdk-php

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

PHP client for Rundeck web API.

## Install

Via Composer

``` bash
$ composer require akramfares/rundeck-sdk-php
```

## Usage

``` php
$client = new Rundeck\Rundeck(ENDPOINT, AUTH_TOKEN, API_VERSION);

// Get all projects
$projects = $client->project()->findAll();

foreach($projects["project"] as $project) {
    echo $project["name"]. "\n";
}

// Get jobs of project
$jobs = $client->project("Project")->get("jobs/export");

foreach($jobs["job"] as $job) {
    echo $job["name"]. "\n";
}

// Get job info
$job = $client->job("c4ec2b60-ac83-4ee2-9266-67ce795c9603")->find();

echo $job["job"]["name"] . ": " . $job["job"]["id"];

// Get job executions
$executions = $client->job("c4ec2b60-ac83-4ee2-9266-67ce795c9603")->get('executions');

foreach ($executions["execution"] as $execution) {
    echo $execution["job"]["name"] . " started at " . $execution["date-started"] ."\n";
}

// Get execution info
$execution = $client->execution("4939")->find();

echo $execution["job"]["name"] . " started at " . $execution["date-started"];

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email akramfares |at| gmail |.| com instead of using the issue tracker.

## Credits

- [Akram Fares][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/akramfares/rundeck-sdk-php.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/akramfares/rundeck-sdk-php/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/akramfares/rundeck-sdk-php.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/akramfares/rundeck-sdk-php.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/akramfares/rundeck-sdk-php.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/akramfares/rundeck-sdk-php
[link-travis]: https://travis-ci.org/akramfares/rundeck-sdk-php
[link-scrutinizer]: https://scrutinizer-ci.com/g/akramfares/rundeck-sdk-php/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/akramfares/rundeck-sdk-php
[link-downloads]: https://packagist.org/packages/akramfares/rundeck-sdk-php
[link-author]: https://github.com/akramfares
[link-contributors]: ../../contributors
