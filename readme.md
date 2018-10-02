# Quality Sistemas
### Teste para Programador PHP

> Utilizado "Laravel 5.7 / MySQL 5.7 / PHP 7.1 | Frontend - Vue 3"

> Como Instalar
```
$ git clone https://github.com/paulopanissa/qualitysistemas qualitysistemas
$ cd qualitysistemas
$ sudo chown -R :www-data ./path/qualitysistemas
$ sudo chmod -R 775 ./path/qualitysistemas/storage
$ sudo chmod -R 777 ./path/qualitysistemas/public/uploads
$ composer install
$ cp .env.exemple .env
$ php artisan key:generate 
```

Configure o Database
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qualitysistemas
DB_USERNAME=root
DB_PASSWORD=root
```

Migrations, Storage e Front-end
```
$ php artisan migrate
$ php artisan db:seed
$ php artisan storage:link
$ cd ./frontend
$ npm install
$ vim ./frontend/src/main.js:8
> edite a linha 'http://qs.localhost:8000' -> coloque a URL que irá utilizar
$ npm run build
```

Abra no Navagador;
Qualquer coisa entre em contato.


- Pacotes Utilizados: Imagem Faker - https://github.com/bluemmb/Faker-PicsumPhotos
