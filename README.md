# Indigo Supervisor Configuration

[![Latest Version](https://img.shields.io/github/release/indigophp/supervisor-configuration.svg?style=flat-square)](https://github.com/indigophp/supervisor-configuration/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/indigophp/supervisor-configuration/develop.svg?style=flat-square)](https://travis-ci.org/indigophp/supervisor-configuration)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/supervisor-configuration.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/supervisor-configuration)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/supervisor-configuration.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/supervisor-configuration)
[![HHVM Status](https://img.shields.io/hhvm/indigophp/supervisor-configuration.svg?style=flat-square)](http://hhvm.h4cc.de/package/indigophp/supervisor-configuration)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/supervisor-configuration.svg?style=flat-square)](https://packagist.org/packages/indigophp/supervisor-configuration)
[![Dependency Status](https://www.versioneye.com/user/projects/549ca8a96b1b81d9a400091d/badge.svg?style=flat)](https://www.versioneye.com/user/projects/549ca8a96b1b81d9a400091d)

**Manage Supervisor configuration in PHP.**


## Install

Via Composer

``` bash
$ composer require indigophp/supervisor-configuration
```

## Usage

Generate and parse configuration for supervisor.

``` php
use Indigo\Supervisor\Configuration;
use Indigo\Supervisor\Configuration\Section\Supervisord;
use Indigo\Supervisor\Configuration\Section\Program;
use Indigo\Supervisor\Configuration\Renderer\Basic;

$config = new Configuration;

$section = new Supervisord(['identifier' => 'supervisor']);
$config->addSection($section);

$section = new Program('test', ['command' => 'cat']);
$config->addSection($section);

echo $renderer->render($config);
```

The following sections are available in this pacakge:

- _Supervisord_
- _Supervisorctl_
- _UnixHttpServer_
- _InetHttpServer_
- _Includes_**
- _Group_*
- _Program_*
- _EventListener_*
- _FcgiProgram_*


*__Note:__ These sections has to be instantiated with a name and optionally a properties array:

``` php
$section = new Program('test', ['command' => 'cat']);
```

**__Note:__ The keyword `include` is reserved in PHP, so the class name is `Includes`, but the section name is still `include`.


### Existing configuration

You can parse your existing configuration, and use it as a `Configuration` object.

``` php
use Indigo\Supervisor\Configuration;
use Indigo\Supervisor\Configuration\Parser\File;

$parser = new File('/etc/supervisor/supervisord.conf');

$configuration = new Configuration;

// argument is optional, returns a new Configuration object if not passed
$parser->parse($configuration);
```

Available parsers:

- _File_
- _Text_


You can find detailed info about options for each section here:
[http://supervisord.org/configuration.html](http://supervisord.org/configuration.html)


## Testing

``` bash
$ phpspec run
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/supervisor-configuration/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
