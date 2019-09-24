# Laravel_Api_Resources_Example

## Composer
> composer install

## Eloquent ORM setup
- Criar uma tabela no MySQL/MariaDB
> create table lara_api

- Cria as tabelas no banco 
> php artisan migrate

- Gera 30 registros
> php artisan db:seed

## Routes
- GET ALL
> http://localhost/lara_api/public/api/articles

- GET SINGLE
> http://localhost/lara_api/public/api/article/10

- POST
> http://localhost/lara_api/public/api/article

- PUT
> http://localhost/lara_api/public/api/article

- DELETE
> http://localhost/lara_api/public/api/article/5
