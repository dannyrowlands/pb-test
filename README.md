pb-test  dannysrowlands@gmail.com  23-09-2021

### PAMPER BOOK – Tech Test Supporting doc.

> Create an API capable of the following operations: Create, Read, Update and Delete on "Appointments".

> Appointments should contain up to 6 relevant fields/relationships (user, time, service etc...)

> Consider modelling two more complicated relationships/entities - eg: User->Appointments? Service->Appointments?
- See models for relationships

> Upon creation and deletion of an appointment the system must send an email? How would this scale?
- See solution below.  Queues will allow these to be handled asynchronously.

> Use any language/framework/app/tool you feel most comfortable

---

> Seed data 
- see DB seeders

> DB Migrations 
- see DB migrations

> ENV variables and secret management
- see .env.example

> Logging - system/application
- see laravel.log for all application messages.

> Monitoring / Alerting
- For a live enviroment I would write monitoring scripts as required.  I would also recommend the use of a tool such as New Relic for real time in depth analysis of all layers of the application.  For real time alerting I would use something like Slack which allows devs/users to monitor channels that will alert if a problem occurs in the live system.

> Unit Tests
- See tests folder

> Functional / Integration Tests
- See tests folder

> API Versioning / API Spec
- The structure built into Laravel and utilised allows for easy versioning of api's and their routes.

> Local development for multiple developers
- using Git, Docker and the .env files each dev should able to quickly and easily configure this project to run on his/her chosen architecture without any issues. 

> Code version control and branch/development life-cycle
- Git would be used for all versioning, this is something that has varied from place to place that I have worked.  It is clear that good versioning has to be observed at all times with appropriate branches being utilised for satelite/internal projects.  It is also however important to keep the codebase as cohesive as possible.  Many disparate repos for the same project/app can lead to massive conflict issues later.  
- Development life cycle would be dictated by the needs of the business.  Flexibility is key and an ability to move quickly when change is required.

> What could a deployment look like? (Infra/CI/CD)
- I set up a full CI pipeline in my last role that was similar to this one.  I was endeavouring to eliminate human error on deployments.  The best way to do this is automate all process where this is possible.  We never reached FULL CI, but we had a pipeline that allowed me to complete a deployment by filling a few parameters such as release number etc.  We were not full CI in the sense that the process did require human triggering.  However once triggered the whole process was automated.  Just not triggered by the deployment of code and tests passing. 



**My framework of choice for this Laravel 8.6.0.**

I will be using ‘Sail’ and docker for the VM setup.  (I previously used Vagrant for all VM’s however I cannot beat Laravel Sail (with Docker) for ease of use out of the box across all OS’s)

I can quickly produce the security and user handling side of this by utilising Laravel Breeze.
This will give me instantly all the auth layer functionality I need (inc optional 2FA).  Saving a huge amount of work.  This Breeze setup also comes with unit and feature testing already in place allowing for quick and easy modification without breaking existing functionality.

Relationships will be defined at the data model level.  This then allows the me to quickly and easily utilise these relationships via shorthand statements within the application.

The API architecture I will build manually.  However Laravel does already come with a pre setup API layer with all authentication built right into the framework out of the box.  This allows secure routes to be set up with minimal coding.  Again saving a lot of programming and testing time.  This will alow me to interact with the API without the need for bespoke verification. For a production API (or given more time on this) where external users would be calling the endpoints I would utilise Laravel's Jetstream module that allows creation of 'teams' with 'members'.  The teams can be used as clients and the API access would then be verfied using a client token and and the client ID.

Front end will be done utilising NPM and Vue JS.

For deployment of this I would ideally have a Jenkins server that runs a set of prebuilt scripts.  These scripts would include setting active sites into maintenance mode (only where absolutely required by the specific release),  any server preparation steps – ie software upgrades etc,  composer installs/updates, migrations required, deployment of new live code and unit/feature test runs required.
This process can be as in depth as is chosen for the specific application and the specific release.  (Automating processes is something I really do enjoy)

The reasoning behind automating as much of these processes a s possible is to eliminate the opportunities for human error wherever possible.  Releases are often broken by a missed step.  Automating all possible processes stops this.

Scaleability wise we could utilise queues to asyncronously handle all tasks such as email sending.  Thus decoupling the front end from the process.  This also scales well as you can set up multiple queues with their own rules to handle all scenarios.  You can also run multiple quese simultaneously to handle larger volume tasks without hindering the front end application.  Queues can be used for pertty much any task that can be run asynchronously.

One other important thing I can also bring is my contacts.  I still have a good relationship with the external team I built when in a previous role.  These guys are excellent coders and can be available on an ad hoc basis if ever required for a fast build project.

## <b>Data Diagram.</b>

###<b>Tables:</b>
failed_jobs, migrations, password_resets, personal_access_tokens, appointments, users, services, times, dates, notes,

### <b>Table fields:</b>

failed_jobs -> id, uuid, connection, queue, payload, exception, failed_at

migrations -> id, migration, batch

password_resets -> email, token, created_at

personal_access_tokens -> id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at

appointments -> id, service_id, date_id, time_id, notes_id, user_id, created_at, updated_at

users -> id, name, email, email_verified_at, password, remember_token, created_at, updated_at

services -> id, name, description, created_at, updated_at

dates -> id, date, time_id, created_at, updated_at

times -> id, time, created_at, updated_at

notes -> id, appointment_id, title, body, created_at, updated_at
