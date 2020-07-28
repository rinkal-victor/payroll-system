

## Payroll System

Run Laravel project locally:

- Download Composer([https://getcomposer.org/download/]).
- Rename .env.example file to .env inside your project root and fill the database information.
- Open the console and cd your project root directory
- Run composer install or php composer.phar
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan db:seed
- Run php artisan serve


## Questions

### Testing application
- You can manually test the application by accessing project locally at access your project at [localhost:8000]
- Also, you can run unit test by running this command inside your project directory from terminal - vendor/bin/phpunit
- Test cases can be found under tests/Unit


### Production environment changes
- A git repository with features development branch and master branch.
- A detailed documentation on all features and business logic in project.
- Make sure deployment user has sufficient rights to web server.
- Lock application- put it in maintenance mode to ensure that no database inconsistency occurs.
- Also, this application was developed under time constraint as a sample code example, so it doesn't cover 100% unit test coverage.
- In a real life project, I would need lot more information on the whole system like number of users, user access authorization and authentication,
  scalability, to make proper decision for designing the whole system including database.
   
