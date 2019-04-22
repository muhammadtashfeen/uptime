# Project - Uptime

The project uptime is monitoring service to keep track of the uptime of the 
website. Everyminute the project checks whether the website being monitored is 
up or down.
Incase it's down the user is notified immediately. 

## Features List
- Monitor downtime
- Notify user

#### Wish List
- Keep stats
- Graphs


## Setting Up Locally

### Database
- Export the database sent along the project
- Change the database configuration settings in config/database.php

### Cron
- Go to terminal and type : crontab -e
- Edit the file and add the follwing command:
> * * * * * php /home/laravel-proj/artisan schedule:run 1>> /dev/null 2>&1
- You are all set to go
