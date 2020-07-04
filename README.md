# Supervisor Configuration

[![Latest Version](https://img.shields.io/github/release/supervisorphp/configuration.svg?style=flat-square)](https://github.com/supervisorphp/configuration/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/supervisorphp/configuration.svg?style=flat-square)](https://travis-ci.org/supervisorphp/configuration)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/supervisorphp/configuration.svg?style=flat-square)](https://scrutinizer-ci.com/g/supervisorphp/configuration)
[![Quality Score](https://img.shields.io/scrutinizer/g/supervisorphp/configuration.svg?style=flat-square)](https://scrutinizer-ci.com/g/supervisorphp/configuration)
[![Total Downloads](https://img.shields.io/packagist/dt/supervisorphp/configuration.svg?style=flat-square)](https://packagist.org/packages/supervisorphp/configuration)

**Manage Supervisor configuration in PHP.**


## Install

Via Composer

```bash
$ composer require supervisorphp/configuration
```

## Usage

Create a configuration using the builder.

```php
$config = new \Supervisor\Configuration\Configuration;
$renderer = new \Indigo\Ini\Renderer;

$section = new \Supervisor\Configuration\Section\Supervisord(['identifier' => 'supervisor']);
$config->addSection($section);

$section = new \Supervisor\Configuration\Section\Program('test', ['command' => 'cat']);
$config->addSection($section);

echo $renderer->render($config->toArray());
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

```php
$section = new \Supervisor\Configuration\Section\Program('test', ['command' => 'cat']);
```

**__Note:__ The keyword `include` is reserved in PHP, so the class name is `Includes`, but the section name is still `include`.


### Existing configuration

You can parse your existing configuration, and use it as a `Configuration` object.

```php
$loader = new \Supervisor\Configuration\Loader\IniFileLoader('/etc/supervisor/supervisord.conf');
$configuration = $loader->load();
```

Available loaders:

- `IniFileLoader`
- `FlysystemLoader` (Using [league/flysystem](https://github.com/thephpleague/flysystem))
- `IniStringLoader`

### Writting configuration

You can use `Writer`s to write configuration to various destinations.

```php
$configuration = new \Supervisor\Configuration\Configuration;

// Modify configuration...

$writer = new \Supervisor\Configuration\Writer\IniFileWriter('/etc/supervisor/supervisord.conf');
$writer->write($configuration);
```

Available writers:

- `IniFileWriter`
- `FlysystemWriter` (Using [league/flysystem](https://github.com/thephpleague/flysystem))


You can find detailed info about properties for each section here:
[http://supervisord.org/configuration.html](http://supervisord.org/configuration.html)


## Testing

```bash
$ composer ci
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/supervisorphp/configuration/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
