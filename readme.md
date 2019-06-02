# Project - Uptime
The project is a online websites/servers downtime notifier tool. A cronjob is
scheduled which runs every minute to check 
whether the server is up and responding.

If the server is not responding an email is generated
to the user notifying about the status of the website/server.
Then when the server is backup user is once again
notified via email and summary of the downtime is given.
 

## Technologies
- Laravel 5.8
- VueJS 
- Tailwind
- Webpack
- SASS

## Features List
- Monitor downtime
- Notify user

## Setting Up Locally

### Database
- Change the database configuration in .env file
- Run the database migrations
```
> php artisan migrate
``` 

### Cron
- Go to terminal and type : crontab -e
```
> crontab -e
```
- Edit the file and add the follwing command:
```
> * * * * * php /home/laravel-project-path/artisan schedule:run 1>> /dev/null 2>&1
```
- You are all set to go

### Email
The email configuration is also performed in the .env file

### Frontend
- To keep track of the frontend run the follwing command 
at terminal in project root
```
> npm run watch
```

#### Wish List
- Keep stats
- Graphs