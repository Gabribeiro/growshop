# Instruções para Execução com Docker

Este documento contém instruções para executar o projeto Laravel usando Docker e Docker Compose.

## Requisitos

- Docker
- Docker Compose

## Configuração

1. Certifique-se de que o arquivo `.env` está configurado corretamente. Você pode usar o `.env.example` como base:

```bash
cp .env.example .env
```

2. Configure as variáveis de ambiente relacionadas ao banco de dados no `.env`:

```
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
```

## Executando o Projeto

1. Construa e inicie os contêineres:

```bash
docker-compose up -d
```

2. Instale as dependências do Composer (caso não tenha feito isto na construção da imagem):

```bash
docker-compose exec app composer install
```

3. Gere a chave da aplicação:

```bash
docker-compose exec app php artisan key:generate
```

4. Execute as migrações:

```bash
docker-compose exec app php artisan migrate
```

5. (Opcional) Execute os seeders:

```bash
docker-compose exec app php artisan db:seed
```

## Acessando a Aplicação

Após a inicialização dos contêineres, a aplicação estará disponível em:

```
http://localhost:8000
```

## Comandos Úteis

- Parar os contêineres:
```bash
docker-compose down
```

- Ver logs dos contêineres:
```bash
docker-compose logs -f
```

- Executar comandos Artisan:
```bash
docker-compose exec app php artisan [comando]
```

- Acessar o shell do contêiner:
```bash
docker-compose exec app bash
```

- Limpar cache:
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

## Resolver Problemas Comuns

### Erro de permissão de arquivos

Se encontrar erros de permissão, execute:

```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/database
``` 