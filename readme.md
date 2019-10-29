<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## About Laravel Queue

“Queues allow you to defer the processing of a time consuming task, such as sending an email, at a later time. By these time consuming tasks will speeds up web requests to your application.”

## Learning Laravel Queue

Laravel queue setup will process in background and user will get quick response in foreground. Laravel Queue officical doc can be found [here](https://laravel.com/docs/5.8/queues)

## Basic Requirements

In .env file add / edit following value

**QUEUE_DRIVER=database**

Create required tables for job using migration. Run the below commands

**php artisan queue:table**

**php artisan queue:failed-table**

**php artisan migrate**

Then create a neccessary route and controller function for mail function, where we going to call job with time delay.

Create a job using command,

**php artisan make:job Jobname**

After dispatching the job, you can check the job execution using the following command,

**php artisan queue:work --tries=1**

If everything is set!, and you go to live. Then queue should run automatically in background without executing the above work command. For this we need to setup the **supervisor**

## Supervisor Installation

Supervisor can be installed in ubuntu/linux server that will automatically execute the queue in server level. To install supervisor, execute the following command.

**sudo apt-get install supervisor**

Then goto the path **/etc/supervisor/conf.d**. There let’s create a **laravel-worker.conf**

In the above laravel-worker.conf file, paste the follwoing lines,

```[program:laravel-worker]

process_name=%(program_name)s_%(process_num)02d

command=php /home/forge/app.com/artisan queue:work --tries=3

autostart=true

autorestart=true

user=forge

numprocs=8

redirect_stderr=true

stdout_logfile=/home/forge/app.com/storage/logs/supervisord.log
```

- **/home/forge/app.com/** this is your project folder path
- **user** this is your server username

After saving the above file, need to update and start the supervisor. Run the follwoing command.

**sudo supervisorctl reread**

**sudo supervisorctl update**

**sudo supervisorctl start laravel-worker:***

If you change laravel-worker.conf file, then every time you have to run the above commands to update the supervisor.
