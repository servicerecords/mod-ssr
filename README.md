# MOD SERVICE RECORDS REQUEST

The SSR is a relatively simple Laravel application. It runs on Laravel 8 with no requirement for a database or any persistent data of anykind. The front is a build of the Government Design System. 

Once cloned it is wise to run, 

    composer install
    npm install

This will install any PHP dependencies and whatever front end dependencies GDS prescribe in their design system.

## Branching

The development process runs essentially in 3 branches, *local*, *development* & *master* the local branch should always be a clone of *development*, as *master* could be behind *development* due to live issue fixes etc. Going forward as the project grows and the team becomes more agile each story/ticket should have it's own branch.  To merge *local* into *development* and *development* into *master* a PR should be created, a code review carried out, and a full test run before a PR is reviewed.


## Third Party Dependencies

We utilise to third party services and their attributed libraries GovPay to take payments, where we have a sandbox and production mode running, and have tested the live enviroment. 

We also run GovNotify which is a notification queue system where we offset and communication too, for us this means sending the DBS offices any requests that the application takes.

## Testing

Testing is based on Webdriver/Selenium tests and are executed as Dusk E2E tests performed under QA. Should a new path taken during QA cause an error,
this path should be replicated as an E2E test and code hardening written to shore up the application.

Execute tests using the Artisan tool:

```
    ./artisan dusk
```

## Deploy

We run continuous deployment from master via Travis. Upon successful branch merge, Travis builds a fresh Docker image, executes smoke tests and
pushes to our Docker Hub instance before Blue/Green deployment to PaaS

## Licence

Unless stated otherwise, the codebase is released under [the MIT License](https://github.com/servicerecords/mod-ssr/blob/master/LICENCE.md). This covers both the codebase and any sample code in the documentation.

The documentation is [© Crown copyright](http://www.nationalarchives.gov.uk/information-management/re-using-public-sector-information/uk-government-licensing-framework/crown-copyright/) and available under the terms of the [Open Government 3.0](http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/) licence.
