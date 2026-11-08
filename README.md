# Tasks for Today — IT0049 TSA4

This Laravel 12 application extends the TSA3 Tasks for Today Management System with authenticated task CRUD, archive-only deletion, validation, and completion email notifications.

## Setup

Run composer install, copy .env.example to .env, and run php artisan key:generate.

Configure the existing MySQL database in .env:

    DB_CONNECTION=mysql
    DB_DATABASE=laravel_tsa4
    DB_USERNAME=root
    DB_PASSWORD=
    MAIL_MAILER=log
    MAIL_TASK_RECIPIENT="weseem.ahmed@example.com"

Run migrations and seed the demo records:

    php artisan migrate:fresh --seed

Start the application with php artisan serve.

## Pages and authentication

Guests can access /, /tasks, /profile, and /about. The task list and task detail pages show only active tasks.

The following task-management actions require authentication and redirect guests to /login: create, store, edit, update, and destroy/archive. Authenticated users can create, edit, update, and archive tasks. Archiving sets is_archived to true; task rows are never permanently deleted.

Demo login:

- Email: weseem.ahmed@example.com
- Password: password

## Email testing

When an existing task changes from a non-done status to done, Laravel sends one TaskCompleted mailable to MAIL_TASK_RECIPIENT. Updating an already-done task does not send another message.

The .env.example uses Laravel's log mail driver, so no real inbox is needed. Inspect storage/logs/laravel.log after completing a task to see the rendered message.

## Verification

    php -l app/Http/Controllers/TasksController.php
    php artisan route:list
    php artisan migrate:fresh --seed
    php artisan test
    vendor/bin/pint --dirty --format agent
    git diff --check
