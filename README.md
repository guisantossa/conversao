<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Sobre o projeto

Projeto desenvolvido em Laravel, um teste para admissão de uma vaga de programador PHP/Laravel.

### Clonar o Projeto

Primeiro de um git clone para baixar todo o projeto

```sh
git clone https://github.com/guisantossa/conversao.git
```
Após acessar a página do projeto instalar as dependencias do projeto

## Configuração - Backend

``` bash
# Instalar dependências do projeto
composer install

# Configurar variáveis de ambiente
cp .env.example .env
php artisan key:generate

# Criar Banco de dados
Ao criar o banco setar o nome em .env

# Criar migrations (tabelas)
php artisan migrate


# Registrar um usuario para login
http://dominio/register
```

