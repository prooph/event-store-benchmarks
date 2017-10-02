# event-store-benchmarks

Benchmarks for prooph event-store

Requirements
------------

- PHP >= 7.1
- PDO_MySQL Extension
- PDO_PGSQL Extension

For MariaDB you need server vesion >= 10.2.6.

For MySQL you need server version >= 5.7.9.

For Postgres you need server version >= 9.4.

For ArangoDB you need server version >= 3.2.

## Test Results

You can check our [test results here](https://gist.github.com/prolic/22ddcace2364be40e569cccecb0fe142).

They were running a notebook with Intel(R) Core(TM) i7-5500U CPU @ 2.40GHz

## Usage

1) Have MySQL, MariaDB, Postgres, ArangoDB installed and running
2) Edit `.env` file and change your db settings
3) run `php src/benchmark.php`
4) enjoy

## Good to know

### Test 7 real world test

This is the most realistic test case that comes close to production usage:
- 50 threads are writing events at the same time
- 6 projections are reading events at the same time
- a total of 12500 events are written
- a total of 25000 events are read

You need to have PHP 7.2 and pthreads extension installed for test7 (real world test).

There is currently a bug in pthreads (https://github.com/krakjoe/pthreads/issues/760)
and a suggested fix, but for now during benchmark the `\Prooph\EventStore\Pdo\Projection\PdoEventStoreProjector`
is patched in order to work with pthreads.

## Support

- Ask questions on [prooph-users](https://groups.google.com/forum/?hl=de#!forum/prooph) mailing list.
- File issues at [https://github.com/prooph/event-store-benchmarks/issues](https://github.com/prooph/event-store-benchmarks/issues).
- Say hello in the [prooph gitter](https://gitter.im/prooph/improoph) chat.

## Contribute

Please feel free to fork and extend existing or add new plugins and send a pull request with your changes!
To establish a consistent code quality, please provide unit tests for all your changes and may adapt the documentation.

## License

Released under the [New BSD License](LICENSE).
