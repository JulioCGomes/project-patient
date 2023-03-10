### Passo a passo
```sh
cd project-patient/
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="Project Crud Laravel"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

API_VIACEP="https://viacep.com.br/ws"
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app com o bash
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```


Rodar as migrations para o projeto.
```sh
php artisan migrate
```

Rodar o seeder para ter os dados.
```sh
php artisan db:seed
```

Storage link para gerar as imagens:
```sh
php artisan storage:link
```

Gerar chave do passport para autenticação:
```sh
php artisan passport:install
```

Acesse o projeto
[http://localhost:8989](http://localhost:8989)
