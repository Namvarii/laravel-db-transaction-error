
## Error production

- create Mysql or MariaDb database
- `php artisan migrate`
- `php artisan serve`
- got to route /test or /test2
- check database

If one of error (throw, column not found error) happen, order will be inserted not rolled back.
