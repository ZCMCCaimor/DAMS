INSTALLATION

Just follow the steps

install xampp
https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.1.12/xampp-windows-x64-8.1.12-0-VS16-installer.exe

install composer
https://getcomposer.org/

-- Download the Code --
-- if ( You have a github account ) --
type this command
git clone https://github.com/reenjie/DAMS

-- go on to the file folder.
create a file named ".env"

============================= .env code ( Please copy and paste ) ====================================================

    APP_NAME=Laravel

APP_ENV=local
APP_KEY=base64:clrIAsDZeuviakyfbIkZLjz43pVdGyNJvQyUnig6pco=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appointment_system
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

GOOGLE_API_CLIENT_ID=633894388009-dq823nvhl97u0okjg7nascsdj451atdo.apps.googleusercontent.com
GOOGLE_API_CLIENT_SECRET=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

=============================================================

after that.
open terminal ..
--make sure you are on the root folder of the system.
type this commands .

composer i

php artisan key:generate

-- before running the command below. make sure xampp server is running.

php artisan migrate --seed

php artisan serve

--------------------------------- Test ---------------------
