
# Reserva Quadra
### Passo a passo
Clone Repositório

Crie o Arquivo .env
```sh
cd reservaquadra/
cp .env.example .env
```

Atualizar as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=ReservaQuadra
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=container_mysql
DB_PORT=3306
DB_DATABASE=reservaquadra
DB_USERNAME=root
DB_PASSWORD=root
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acessar o container
```sh
docker-compose exec container_php bash
```


Instalar as dependências do projeto
```sh
composer update
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Acessar o projeto
[http://localhost:8989](http://localhost:8989)
