## CoreNotes Back-end Api Challange

Consiste em um sistema back-end para gerenciamento de Notes(Anotações) do CoreNotes, desenvolvida com laravel 8, aproveitando a facilidade da comunicação entre os componentes proposta pelo framework, utilizando estrutura MVC, a api faz conexão com o banco de dados, cuidando da regra de negócio, armazenamento de dados, autenticação de usuário, com ela é possível:
1. Criar conta, utilizando nome, email e senha do usuário, estrutura de tabela que já vem preparada no laravel.
2. Fazer login e gerenciar suas notas que só você poderá ter acesso, já que a api conta com um relacionamento entre as duas tabelas, User e Notes. A autenticação foi feita com Sanctum, pré-instalado pela laravel.
2. Criar, listar(com filtros de título e cor), editar e excluir uma nota. 
3. Marcar uma anotação como favorita, inclusive a lista é ordenada por favoritos, de maneira decrescente.
4. Define uma cor para cada anotação.

Pronta para ser utilizada com o front-end feito em React TS(<a href="https://github.com/victor-figueiredo/corenotes-web-challange-react">link do repositório front-end</a>), que ao conectar deve exibir a lista de tarefas do usuário de maneira responsiva e visualmente atraente.

## Passos para rodar este Back-end no seu computador

### Pré-requisitos
- PHP >= ^7.4
- Laravel: ^8.0

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
# Prompts WSL (git bash, cmder...)
touch database/database.sqlite
# OU
# Prompt de comando windows:
type nul > database/database.sqlite
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

### Se você ainda não rodou o front-end da aplicação na sua máquina, <a href="https://github.com/victor-figueiredo/corenotes-web-challange-react">clique aqui</a> para acessar o repositório para clonar e seguir o passo a passo das configurações.

#### 👋 Eu, Victor Figueiredo, sou grato a Corelab pela oportunidade, conhecer um pouco desta empresa e poder participar deste processo é muito satisfatório.
