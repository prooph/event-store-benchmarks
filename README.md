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

### Docker and Docker Compose
If you want to run the benchmark suite you need [Docker](https://docs.docker.com/engine/installation/ "Install Docker")
and [Docker Compose](https://docs.docker.com/compose/install/ "Install Docker Compose").

Install dependencies with:

```
$ docker run --rm -i -v $(pwd):/app prooph/composer:7.2 update -o
```

Then you can simply run the `bench_docker.sh` script for each driver (`arangodb` `postgres` `mysql` `mariadb`):

```
$ . bench_docker.sh --driver postgres
```

Or to run all benchmarks

```
$ . bench_docker_all.sh > results.log
```

### Manual

1) Have MySQL, MariaDB, Postgres, ArangoDB installed and running
2) Edit `.env` file and change your db settings
3) Create the test database according to your settings
4) run `. bench.sh --driver postgres` or `. bench_all.sh > results.log` or `. bench.sh --driver postgres,arangodb`
5) enjoy

## Good to know

### Test 7 real world test

This is the most realistic test case that comes close to production usage:
- 50 processes are writing 250 events at the same time
- 6 projections are reading events at the same time
- a total of 12500 events are written
- a total of 15000 events are read

## Support

- Ask questions on Stack Overflow tagged with [#prooph](https://stackoverflow.com/questions/tagged/prooph).
- File issues at [https://github.com/prooph/event-store-benchmarks/issues](https://github.com/prooph/event-store-benchmarks/issues).
- Say hello in the [prooph gitter](https://gitter.im/prooph/improoph) chat.

## Contribute

Please feel free to fork and extend existing or add new plugins and send a pull request with your changes!
To establish a consistent code quality, please provide unit tests for all your changes and may adapt the documentation.

## License

Released under the [New BSD License](LICENSE).
