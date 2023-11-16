

Duration
- xxxxxxxxxxxxx

Members
- xxxxxxxxxxxxx
## Installation

Clone project

```
git clone https://github.com/Yair-Htut-Khaung-SCM/Seller.git
```

Go to project folder
```
cd car-seller
```

Install dependencies
```
composer install
```

Enviromnent Setup
```
cp .env.example .env
```

Generate key
```
php artisan key:generate
```

Setup database in `.env` file
```
APP_URL=http://(Your_Computer_IP_Address) : (port_number)

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Migrate database
```
php artisan migrate:refresh --seed
```

Linking Storage with Public
```
php artisan storage:link
```

Run below command
```
 php artisan serve --host (Your_Computer_IP)  --port (port_number)
```

