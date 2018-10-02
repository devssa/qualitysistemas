# Quality Sistemas
### Teste para Programador PHP

> Utilizado "Laravel 5.7 / MySQL 5.7 / PHP 7.1 | Frontend - Vue 3"
> Container Docker Utilizado: [Homestead](https://hub.docker.com/r/shincoder/homestead)

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
NGINX
```
$ sudo vim /etc/nginx/sites-available/qualitysistemas.conf
server {
    listen 80;
    server_name localhost;
    root "/path/project/qualitysistemas";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log off;
    error_log  /var/log/nginx/qualitysistemas-error.log error;

    error_page 404 /index.php;

    sendfile off;

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/run/php/php7.1-fpm.sock;
        fastcgi_index index.php;
        # include fastcgi_params;
        include fastcgi.conf;
    }

    location ~ /\.ht {
        deny all;
    }
}
# Criar symbolic link
$ sudo ln -s ~/etc/nginx/sites-available/qualitysistemas.conf ~/etc/nginx/sites-enabled/qualitysistemas

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
