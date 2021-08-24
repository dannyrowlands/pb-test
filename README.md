pb-test  dannysrowlands@gmail.com  23-09-2021

PAMPER BOOK – Tech Test Supporting doc.

> Create an API capable of the following operations: Create, Read, Update and Delete on "Appointments".

> Appointments should contain up to 6 relevant fields/relationships (user, time, service etc...)

> Consider modelling two more complicated relationships/entities - eg: User->Appointments? Service->Appointments?

> Upon creation and deletion of an appointment the system must send an email? How would this scale?

> Use any language/framework/app/tool you feel most comfortable

My framework of choice for this Laravel 8.6.0.

I will be using ‘Sail’ and docker for the VM setup.  (I previously used Vagrant for all VM’s however I cannot beat Laravel Sail (with Docker) for ease of use out of the box across all OS’s)

I can quickly produce the security and user handling side of this by utilising Laravel Breeze.
This will give me instantly all the auth layer functionality I need (inc optional 2FA).  Saving a huge amount of work.  This Breeze setup also comes with unit and feature testing already in place allowing for quick and easy modification without breaking existing functionality.

Relationships will be defined at the data model level.  This then allows the me to quickly and easily utilise these relationships via shorthand statements within the application.

The API side of it I will build manually.  However Laravel does already come with a pre setup API layer with all authentication built right into the framework out of the box.  This allows secure routes to be set up with minimal coding.  Again saving a lot of programming and testing time.

Front end will be done utilising NPM and Vue JS.

For deployment of this I would ideally have a Jenkins server that runs a set of prebuilt scripts.  These scripts would include setting active sites into maintenance mode (only where absolutely required by the specific release),  any server preparation steps – ie software upgrades etc,  composer installs/updates, migrations required, deployment of new live code and unit/feature test runs required.
This process can be as in depth as is chosen for the specific application and the specific release.  (Automating processes is something I really do enjoy)

The reasoning behind automating as much of these processes a s possible is to eliminate the opportunities for human error wherever possible.  Releases are often broken by a missed step.  Automating all possible processes stops this.

Scaleability wise we could utilise queues to asyncronously handle all tasks such as email sending.  Thus decoupling the front end from the process.  This also scales well as you can set up multiple queues with their own rules to handle all scenarios.  You can also run multiple quese simultaneously to handle larger volume tasks without hindering the front end application.  Queues can be used for pertty much any task that can be run asynchronously.

One other important thing I can also bring is my contacts.  I still have a good relationship with the external team I built when in a previous role.  These guys are excellent coders and can be available on an ad hoc basis if ever required for a fast build project.


<b>Data Diagram.</b>

<b>Tables:</b>
failed_jobs, migrations, password_resets, personal_access_tokens, appointments, users, services, times, dates, notes,


<b>Table fields:</b>

failed_jobs -> id, uuid, connection, queue, payload, exception, failed_at

migrations -> id, migration, batch

password_resets -> email, token, created_at

personal_access_tokens -> id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at

appointments -> id, service_id, date_id, time_id, notes_id, created_at, updated_at

users -> id, name, email, email_verified_at, password, remember_token, created_at, updated_at

services -> id, name, description

dates -> id, date, time_id

times -> id, time

notes -> id, title, body
