# Qlanka

A fresh Laravel + Livewire quiz app.

## Tech stack
- PHP, Laravel, Livewire
- Pest for tests

## Local development
1. Copy `.env.example` to `.env` and configure DB/mail.
2. Install deps and generate key:
   - composer install
   - php artisan key:generate
3. Run migrations and seed demo data:
   - php artisan migrate --seed
4. Start the server:
   - php artisan serve

## Testing
- Run test suite: `php artisan test` or `./vendor/bin/pest`

## Deployment notes
- Ensure `APP_KEY` is set.
- Configure storage symlink: `php artisan storage:link`.
- Cache config for perf: `php artisan config:cache`.
