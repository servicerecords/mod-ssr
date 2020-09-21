# MOD SERVICE RECORDS REQUEST

The SSR is a relatively simlple Laravel application. It runs on Laravel 6.18.2 with no requirement for a database or any persistent data of anykind. The front is a build of the Government Design System. 

Once cloned it is wise to run, 

    composer install
    npm install

This will install any PHP dependencies and whatever front end dependencies GDS prescribe in their design system.

**Branching**

The development process runs essentially in 3 branches, *local*, *development* & *master* the local branch should always be a clone of *development*, as *master* could be behind *development* due to live issue fixes etc. Going forward as the project grows and the team becomes more agile each story/ticket should have it's own branch.  To merge *local* into *development* and *development* into *master* a PR should be created, a code review carried out, and a full test run before a PR is reviewed.


**Third Party Dependencies**

We utilise to third party services and their attributed libraries GovPay to take payments, where we have a sandbox and production mode running, and have tested the live enviroment. 

We also run GovNotify which is a notification queue system where we offset and communication too, for us this means sending the DBS offices any requests that the application takes.

##Testing

Tests should be written for every new piece of functionality that is written for this service. The test suite is run by Travis everytime a push is made to any branch, but test should also be run locally using Phpunit.


##Build


##Deploy

Continuous deployment from master 
The application is hosted on GovPaas which is essentially cloud based hosting from Cloudfoundry. Deployment is automated with every push to development and master, there should be no need to change the development flow or the .travis.yml file, if there is only a develop that understands or has experience of Travis or CI should do so. 

There are some private keys and passwords that are stored and encrypted within travis it's self. Again these should only be changed or edited by a developer, some that understands the infrastructure or CI.

If deploying failes for whatever reason, or CI cannot be run, you can login to Cloudfoundry via a terminal window and run `cf push` this will push the current directory to Cloudfoundry not automated tested or any other process will be run however. 


##Licence

Unless stated otherwise, the codebase is released under [the MIT License](https://github.com/servicerecords/mod-ssr/blob/master/LICENCE.md). This covers both the codebase and any sample code in the documentation.

The documentation is [© Crown copyright](http://www.nationalarchives.gov.uk/information-management/re-using-public-sector-information/uk-government-licensing-framework/crown-copyright/) and available under the terms of the [Open Government 3.0](http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/) licence.
