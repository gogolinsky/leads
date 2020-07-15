# Instructions
- Clone project `git clone git@github.com:gogolinsky/leads.git leads-crm`.
- Go to project folder `cd leads-crm`.
- Install composer packages: `composer install`.
- Create databases: `touch databases/sqlite.db`.
- Copy .env file: `cp .env.schema .env`.
- Init database: `php yii migrate --interactive=0`.
- Populate database: `php yii lead/populate`.
- Run server `php -S 127.0.0.1:8080 -t web`.
- Run commands from /requests.http.