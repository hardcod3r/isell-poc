# Isell.inc - Lara - PoC
Eshop  Laravel PoC
## Installation

Clone this repo
```sh
git clone https://github.com/hardcod3r/isell-poc.git
cd isell-poc
```

Install dependencies
NOTICE! Use WSL2 if you are running under windows.
```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
Add alias for sail & start sail in backgroind
```sh
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

mv .env.example .env

sail up -d
```


Install app && seed db
```sh
sail artisan app:install
```

Run admin manager in CLI
```sh
sail artisan app:admin
```
Run shop in CLI
```sh
sail artisan app:shop

Happy shopping!!
```
