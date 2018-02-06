## Spray Diary Project

## Usage

- Clone the repository with `git clone`
- Copy `.env.example` file to `.env` and edit database credentials there
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate --seed` (it has some seeded data - see below)
- That's it: launch the main URL and login with default credentials `admin@admin.com` - `password`

This boilerplate has one role (`administrator`), one permission (`users_manage`) and one administrator user.

With that user you can create more roles/permissions/users, and then use them in your code, by using functionality like `Gate` or `@can`, as in default Laravel, or with help of Spatie's package methods.

