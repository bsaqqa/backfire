# Backfire

PHP CLI For Auto Backup DB.

You can run it as a cron job on Windows/Ubuntu servers to do daily backup of your database.

# Features

- [X] Easy to install and configure
- [X] Can be run as a cron job on Windows and Ubuntu servers
- [X] Create it as a composer package
- [X] Supports multiple database servers (Multiple connection)
- [ ] Supports different database engines (Coming Soon)
- [ ] Supports automatic restoration of backups (Coming Soon)
- [ ] Supports email notifications (Coming Soon)
- [ ] Supports OneDrive integration (Coming soon)
- [ ] Supports cloud storage (Coming Soon)
- [ ] Supports encryption of backups (Coming Soon)

# Roadmap

I plan to continue developing and enhancing the **Backfire** in the future. Below is a list of features I plan to add in the future:

- [X] Easy to install and configure
- [X] Can be run as a cron job on Windows and Ubuntu servers
Customizable backup frequency and destination

- [X] Create it as a composer package:
Currently, Backfire is not available as a composer package. In the future, I plan to create it as a composer package to make it easier for users to install and use Backfire.

- [X] Implement support for multiple database servers: 
Currently, Backfire only supports backing up databases on a single server. In the future, I plan to add support for backing up databases on multiple servers.

- [ ] Add support for different database engines: 
The script currently only supports MySQL databases. In the future, I plan to add support for other database engines such as PostgreSQL and SQL Server.


- [ ] Improve error handling: I plan to improve Backfire's error handling to make it more robust and user-friendly.

- [ ] Add support for automatic restoration of backups: Currently, Backfire only supports creating backups. In the future, I plan to add support for automatically restoring backups in case of data loss.

- [ ] Add support for email notifications: I plan to add the ability to send email notifications to users when a backup is created or when an error occurs.

- [ ] Improve documentation and examples: I plan to improve the documentation and examples provided in the repository to make it easier for users to get started with Backfire.

- [ ] Add support for cloud storage: Currently, Backfire only supports saving backups to a local folder. In the future, I plan to add support for other cloud storage providers such as OneDrive, Google Drive and Dropbox.

- [ ] Add support for encryption of backups: I plan to add the ability to encrypt backups to protect sensitive data.
This roadmap represents our current plans for the development of the **Backfire**, but it is subject to change as I receive feedback and suggestions from users.


I welcome any feedback or ideas you have for improving Backfire, and I look forward to continuing to develop and enhance it in the future.
 



# Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## 1.1 Prerequisites

You need to have PHP >=8.0 and [Composer](https://getcomposer.org/) installed on your machine.

## 1.2 Installing

1. Run install command

```shell
  composer global require bsaqqa/backfire
```
2. Run install command to install package dependencies and initialize it

```shell
  backfire install
```


3. Open `~/.backfire/backfire.config.php` file or using below command to edit it with your database credentials

```php

```shell
  backfire open-config   
```

4. Edit the following variables to match your DB information and backup folder path:

```php
"connections" => [
  "default" => [ // connection name that will be used in the command line to select the connection (you can add more than one connection)
      'type' => 'mysql', // in the future we will support more types
      'host' => 'localhost',
      'port' => 3306,
      'username' => 'root',
      'password' => '',
      'database' => 'backfire',
  ],
  // ... more connections -> You can add more connections
],
 /**
     * Storage config
     *
     */
    "storage" => [
        //...,
        'path' => 'storage/backups', // relative to the user home directory
    ],

```



## 1.3 How to use

You can run it with below command:

```shell
  backfire backup
```




## 1.4 How to setup cron job on Windows

![image](https://user-images.githubusercontent.com/21352835/211493648-121ecdf5-02f9-4ffd-a344-94ba80f7d452.png)


You can setup cron job on Windows using schedule with below steps:

1. Open Task Scheduler
2. Click Create a Basic Task
3. Enter a name for the task
4. Select "Run whether user is logged on or not"
5. Check "Run with highest privileges"
6. Click on "Triggers"
7. Click New
8. Select "Daily"
9. Click OK
10. Click on "Actions"
11. Click New
12. Select "Start a program"
13. Enter the path to "`backfire.bat`" in the field
14. Enter `backup` argument in the "Add arguments" field
15. Click OK


## 1.5 How to setup cron job on Ubuntu

You can setup cron job on Ubuntu using crontab with below steps:

1. Open terminal
2. Run crontab
        
        crontab -e

3. Add the following line to the end of the file:

        0 0 * * * backfire backup


4. Save and exit




# License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
