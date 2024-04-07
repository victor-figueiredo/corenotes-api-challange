## CoreNotes Back-end Api Challange

Consiste em um sistema back-end para gerenciamento de Notes(Anotações) do CoreNotes, desenvolvida aproveitando a facilidade da comunicação entre os componentes proposta pelo laravel, e utilizando estrutura MVC.

Esta Api permite:
1. Criar, listar(com filtros de título, conteúdo ou cor), atualizar, excluir e ordenar por favoritos.
2. Marcar uma anotação como favorita.
3. Definir uma cor para cada anotação.
4. As anotações favoritas serão retornadas no topo da lista.

Desenvolvida em PHP 7.4, utilizando Laravel 8.

Pronta para ser utilizada com o front-end feito em React(<a href="https://github.com/victor-figueiredo/corenotes-web-challange-react">link do repositório</a>), que ao conectar deve exibir a lista de tarefas do usuário de maneira responsiva e visualmente atraente.

## Passos para utilizar este Back-end no seu computador
### 1 - Clonando o repositório
```bash
git clone git@github.com:victor-figueiredo/corenotes-api-challange-php.git
cd corenotes-api-challange-php
```

### 2 - Baixar e instalar as dependências
```bash
composer install
```

### 3 - Crie um arquivo de banco de dados sqlite
#### 3.1 - Windows
```bash
# Prompt de comando windows:
type nul > database/database.sqlite
# Git bash
touch database/database.sqlite
```
#### 3.2 - linux ou macOS
```bash
touch database/database.sqlite
```

### 4 - Como o banco de dados utilizado é local, eu permiti que o .gitignore suba .env para o repositório, agilizando o processo.
### Agora é só executar os seguintes códigos para rodar o backend.
```bash
php artisan migrate
php artisan serve
```

### Eu, Victor Figueiredo, sou grato a Corelab pela oportunidade, poder participar deste processo é muito satisfatório.
