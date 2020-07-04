# Change Log

## 0.3.0 - 2020-07-04

### Added

- Re-added `IniFileLoader` and `IniFileWriter` that have no Flysystem dependency.

### Changed

- Minimum PHP version updated to 7.3
- Methods now have typed parameters and return types
- League/Flysystem is now a suggested, but not required, library.
- Moved `Loader` interface to `Loader/LoaderInterface`
- Moved `Writer` interface to `Writer/WriterInterface`
- Moved `Section` interface to `Section/SectionInterface`
- Loaders now inherit from a `Loader/AbstractLoader` class
- Writers now inherit from a `Writer/AbstractWriter` class
- Moved from Travis CI and Scrutinizer to GitHub Actions

## 0.2.0 - 2015-01-04

### Changed

- Updated to use [indigophp/ini](https://github.com/indigophp/ini)
- Renamed Parser to Loader
- Renamed Filesystem Loader to IniFileLoader
- Renamed Filesystem Writer to IniFileWriter
- Renamed Text Loader to IniStringLoader
- Moved everything under one namespace
- Renamed exceptions according to their usage
- Moved section mapping from loader to configuration


### Removed

- Renderer
- File Loader (Parser previously)
- File Writer
- Unused stubs


## 0.1.0 - 2014-01-04

### Added

- Created split from the main repository
