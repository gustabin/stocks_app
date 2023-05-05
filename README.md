README

This is a web application that allows users to manage and keep track of their stocks. It has been developed using the Slim framework, Firebase/PHP-JWT for authentication, Swiftmailer for sending email notifications, Twig for the template engine, and Symfony/Dotenv for handling environment variables.

## Installation

To install this application, follow these steps:

1. Clone the repository to your local machine: `git clone https://github.com/gustabin/stocks_app.git`
2. Install the required dependencies using Composer: `composer install`
3. Create a MySQL database and import the `database.sql` file provided in the `config` directory.
4. Create a `.env` file in the root directory and set the database connection variables:
   ```
   DB_HOST=localhost
   DB_NAME=your_database_name
   DB_USER=your_database_username
   DB_PASS=your_database_password
   ```
5. Start the application by running the command `php -S localhost:8000 -t public`

## Usage

Once the application is installed and running, you can access it by visiting `http://localhost:8000` in your web browser.

### Authentication

To use the application, you must first create an account by clicking the "Register" button and filling in the registration form. Once registered, you can log in by clicking the "Login" button and entering your email and password.

### Managing Stocks

After logging in, you can manage your stocks by clicking the "My Stocks" link in the navigation bar. From here, you can add new actions and see your history of actions or that of other clients.

### Email Notifications

The application has a function that allows you to receive email notifications when you consult a stock.

## Testing

This application has unit tests implemented using PHPUnit. To run the tests, execute the command `vendor/bin/phpunit` from the root directory of the project.

## Contributing

If you would like to contribute to this project, please follow these steps:

1. Fork the repository to your own account.
2. Create a new branch with your changes: `git checkout -b my-feature-branch`
3. Make your changes and commit them: `git commit -am 'Add some feature'`
4. Push your changes to your forked repository: `git push origin my-feature-branch`
5. Create a pull request on the original repository.

## License

This application is licensed under the MIT License. See the `LICENSE` file for details.
