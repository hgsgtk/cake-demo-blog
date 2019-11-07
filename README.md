# Blog application for TDD demonstration driven by CakePHP

[![Build Status](https://travis-ci.com/hgsgtk/cake-demo-blog.svg?branch=master)](https://travis-ci.com/hgsgtk/cake-demo-blog)

A blog created by  [CakePHP](https://cakephp.org) 4.x.


## Install

To run this application in local environment, you should install docker.

## Getting started

Start up docker container services by docker-compose.

```
docker-composer up -d
```

Install dependencies.

```
docker-compose run composer install --ignore-platform-reqs
```

Run migration.

```
docker-compose run php-cli bin/cake migrations migrate
```
