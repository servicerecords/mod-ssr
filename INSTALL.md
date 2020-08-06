## Installation

```
$ git clone https://github.com/servicerecords/mod-ssr.git .
$ cd mod-ssr
$ composer install && npm install
```

Create you own development environment variable file by copying the existing example file for reference

```
$ cp .env.example .env
```

Generate a unique application key

```
$ ./artisan key:generate
```
### Creating Your Sentry.io Key

If not already done, create a free account at [https://sentry.io](https://sentry.io). Once yur free account is create you will need to verify your account, however you will be presented with the 

Add your SENTRY_LARAVEL_DSN environment variable to your .env file. The line you need to add appears similar to

```
SENTRY_LARAVEL_DSN=https://XXXXXXXXXXXX.ingest.sentry.io/#######
```

Test that your Sentry.io account can communicate with the service

```
$ ./artisan sentry:test
[sentry] Client DSN discovered!
[sentry] Generating test event
[sentry] Sending test event
[sentry] Event sent with ID: 6205318fb0594fb3a7849af6a0c0e6bb
```

We can start the server using the built-in webserver. 

This is not a replacement for a fully fledge IIS, Apache or Nginx HTTP server. This should not be used outside of your development environment.
```
$ ./artisan serve

PHP 7.4.3 Development Server (http://127.0.0.1:8000) started
```

The frontend needs building

```
$ npm dev
```



### Testing

$ docker pull selenium/hub
$ docker pull selenium/node-chrome
$ docker pull selenium/node-firefox

$ docker run -d -p 4444:4444 --name hub selenium/hub
$ docker run -d -P --link hub:hub --name chrome selenium/node-chrome
$ docker run -d -P --link hub:hub --name firefox selenium/node-firefox

$ docker logs hub

```
06:39:01.843 INFO [GridLauncherV3.parse] - Selenium server version: 3.141.59, revision: e82be7d358
06:39:01.900 INFO [GridLauncherV3.lambda$buildLaunchers$5] - Launching Selenium Grid hub on port 4444
2020-08-06 06:39:02.218:INFO::main: Logging initialized @521ms to org.seleniumhq.jetty9.util.log.StdErrLog
06:39:02.312 INFO [Hub.start] - Selenium Grid hub is up and running
06:39:02.313 INFO [Hub.start] - Nodes should register to http://172.17.0.2:4444/grid/register/
06:39:02.313 INFO [Hub.start] - Clients should connect to http://172.17.0.2:4444/wd/hub
06:39:03.025 INFO [DefaultGridRegistry.add] - Registered a node http://172.17.0.3:5555
06:39:04.049 INFO [DefaultGridRegistry.add] - Registered a node http://172.17.0.4:5555
```
