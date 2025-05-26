# 📦 Desafio Engeselt Softwares - Desenvolvedor Web PHP JR

Este projeto utiliza o framework Laravel. Abaixo estão os passos completos para rodar o ambiente local, indicamos o uso do laradock onde abaixo deixaremos um link de exemplificação de uso, porém pode ser feito uso do laravel sail, docker... O importante é que o projeto seja executado e consiga ser feito as devidas tratativas.

---

## Requisitos ✅✨

-   PHP >= 8.3
-   Composer 2.8.5
-   PostgreSQL 17
-   Node.JS 22.16.0 (LTS)
-   Docker 28.1

## Executando o Projeto Localmente 🚀✨

### 1. Clone o repositório 😎

```
git clone https://git.engeselt.com.br/wesley.silva/desafio-php.git
```

### 2. Copie o arquivo .env 📂

```
cp .env.example .env
```

### 3. Configuração do Laradock e Execução do Projeto 🚀

> Recomendamos o uso do Laradock, mas sinta-se livre para executar o projeto da forma que for mais conveniente para você.

[Clique aqui para acessar um tutorial de configuração do Laradock](https://youtu.be/4oO_ZGX3Rbs?si=dFLaG_HvlAOU5uiv)

Na raiz do projeto há um arquivo `.env.laradock.example`, nele já está definido todo o ambiente com as respectivas versões das tecnologias utilizadas.

1° - Na raiz do projeto, utilize o comando abaixo para copiar o arquivo `.env.laradock.example` para a raiz do seu Laradock:

```
cp .env.laradock.example laradock/.env
```

> Dependendo da sua estrutura de pastas, será necessário ajustar o path de destino.

2° - Cerifique-se de ter o Docker instalado, caso não tenha [clique aqui para seguir o passo a passo para instalação](https://docs.docker.com/get-started/get-docker/).

3° - Na raiz do seu Laradock execute o comando abaixo:

```
docker compose up -d postgres nginx
```

> Dependendo da sua conexão com internet, o processo pode ser um pouco demorado, pois ao executar pela primeira vez o Docker irá baixar as imagens dos respectivos containers.

4° - Crie a base de dados `chamados` que será utilizada pela aplicação:

-   Conecte-se ao container do PostgreSQL:
    ```
    docker exec -it laradock-postgres-1 bash
    ```
-   Conecte-se ao servidor do PostgreSQL:
    ```
    psql -h localhost -U default -w
    ```
-   Crie o banco de dados:
    ```
    CREATE DATABASE chamados;
    ```
-   Desconecte-se do servidor do PostgreSQL:
    ```
    \q
    ```
-   Por fim, encerre a sessão no bash do container:
    ```
    exit
    ```

5° - Agora vamos: instalar as dependências do projeto, executar as migrations, executar as seeders, gerar a app key e instalar as dependências do front-end:

-   Conecte-se ao Workspace:
    ```
    docker exec -it laradock-workspace-1 bash
    ```
-   Instale as dependências do projeto:
    ```
    composer install
    ```
-   Execute as migrations e seeders:

    ```
    php artisan migrate:fresh --seed
    ```

    > Esse comando é responsável por criar a estrutura e popular seu banco de dados com alguns dados iniciais.

-   Gere a APP Key do Laravel:
    ```
    php artisan key:generate
    ```
-   Instale as dependências do front-end:
    ```
    npm install
    ```

6° - Ainda no Workspace, vamos executar o front-end da aplicação:

```
npm run dev
```

Pronto, agora será possível acessar a aplicação através do link: [http://localhost](http://localhost).

### 4. Usuários de Acesso 🧑‍💻

A aplicação conta com dois usuários para que você possa utilizar para testar a aplicação.

| E-mail               | Senha                | Role        |
| -------------------- | -------------------- | ----------- |
| colaborador@mail.com | colaborador#engeselt | Colaborador |
| tecnico@mail.com     | tecnico#engeselt     | Técnico     |

-   Role Colaborador: Pode criar novos chamados, acompanhar os chamados existentes e filtrar os chamados;
-   Role Técnico: Pode visualizar todos os chamados, acompanhar os chamados existentes e filtrar os chamados;

### 5. Agora é com Você! 🚀

As atividades a serem executadas neste projeto estão detalhadas no arquivo enviado por e-mail.

Boa sorte, **#VaiDarCerto!**
