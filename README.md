# Task-Management-System

## Description
- Laravel version 10
- PHP 8.1
- Installed laravelcollective package
- For good user interface, I installed a free theme (AdminLte)
- In this project two user group Manager and Teammates. But User group management is here, Manager can ceate multiple user group.
- Manager can signup from register module and after manager login, Manager can create Teammates with their info.
- Manager can create Project, Task (Depend on projects), then Assign tasks to Teammates.
- Manager can see all assigned task with details and filter with Teammate name, Project name, Task name and Status.

- Teammates can login with their email and password.
- Teammates can see only his/her assigned task with details and filter with Project name, Task name and Status in My Tasks module.
- Teammates can change his/her task status with two button(Working and done)

## Installation
- For clone this project run this command: git clone https://github.com/shakil566/Task-Management-System.git
- Create a database
- Then rename .env.example file to .env file and add database name

- Then run these command: 
- composer update
- npm install
- npm run dev
- php artisan key:generate
- php artisan migrate
- php artisan optimize:clear (optional)
- php artisan serve

- if you want existing data, then need to run these seeder command or project root directory has tms_full_database file exists.
- php artisan db:seed --class=UserGroupSeeder
- php artisan db:seed --class=UserSeeder
- php artisan db:seed --class=ProjectSeeder
- php artisan db:seed --class=TaskSeeder
- php artisan db:seed --class=AssignTaskSeeder

- After installation you can login with these credentials if you want. Or you can signup as Manager.

- Manager credentials:
- email:manager@gmail.com
- password:Admin123@

- Teammates credentials:
- email:rakib@gmail.com
- password:Admin123@
