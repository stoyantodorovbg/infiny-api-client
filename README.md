# Infiny API Client

API Client to connect to [Infiny API](https://cloudlx.epsilontel.com/api-documentation).

## Installation

### LAMP
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build # or sail npm run dev
```
Browser access: depends on Web server configurations

### Docker
```bash
composer install
cp .env.example .env
sail up -d
sail artisan key:generate
sail artisan migrate
sail npm install
sail npm run build # or sail npm run dev
```
Browser access: [<your-host>:<your-port>]() (default from .env.example - [http://localhost:8082]())


## Usage
- Register a user
- Create a client
- View Infiny data

## Testing
```bash
sail artisan test # php artisan test
```
