### Paleidimas
Sukonfiguruoti prisijungimą prie duombazės .env faile (pavyzdys .env.example)

```bash
composer install
```
Sukuriame duombazę
```bash
php bin/console doctrine:database:create
```
Paleidžiame migracijas
```bash
php bin/console doctrine:migrations:migrate
```
Įrašome keletą knygų bei autorių į duombaze
```bash
php bin/console doctrine:fixtures:load
```
```bash
symfony server:start
```
