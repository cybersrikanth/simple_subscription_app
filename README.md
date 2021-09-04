## Subscription App

This is a simple subscription platform in which users can subscribe to a website. There can be multiple websites. Users will recive email notification if the subscribed website have new posts.

#### Start the app

* clone the code using git clone URL.
* create .env file same like .env.example (Replce credntials accordingly).
* To use seperate test environment, create .env.testing file.
* Run php `artisan config:cache`, so that environments from .env file will be cached.
* Run `php artisan migrate` to run migration and create tables.
* To run test case, first run `php artisan migrate --env=testing`. This command will create tables in test database.
* Then run `php artisan config:clear --env=testing && php artisan test --env=testing && php artisan config:clear`. This will clear old config in test environment, then run test case with test environment and then finally clears config cache in local environment.
* After running test case, API document will be generated in `storage/app/public` directory        .
* Run `php artisan storage:link`, this command will create symlink for that directory in doc root. So that generated API docs can be viewed in browser.
* Start dev server by running `php artisan serve`. Go to http://localhost:8000/storage/docs.html to view generated API docs.
* To process jobs, run `php artisan queue:work`. In production, this might need to run with supervisor.
* Paste the following line in crontab file to run scheduled jobs.
`* * * * * php /path/to/project/artisan schedule:run`


#### Custom Commands
* To send Email to all subscribers from CLI type `php artisan notice:mail`. I        t will prompt for subject and content, which will be sent to all subscribers via email.
* `php artisan posts:queue` command will inititate job to send notification to subscribers for new posts. (This will be run by cron job every minute)