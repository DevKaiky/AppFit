# AppFit

Aplicação web de desafios fitness construída em **PHP puro**, sem framework, para a disciplina
de Aplicações para a Internet. O objetivo do trabalho era implementar do zero um MVC com
roteamento, camada de acesso a dados e autenticação.

## Funcionalidades

- Cadastro, login e gerenciamento de perfil de usuário
- CRUD de desafios de exercício (título, descrição, nível)
- Acompanhamento de progresso do usuário em cada desafio
- Área administrativa para gerenciar usuários e desafios
- Controle de acesso por sessão (usuário comum x admin)

## Stack

- PHP 8+ com PDO
- MySQL / MariaDB
- HTML + CSS (sem bibliotecas de front-end)

## Arquitetura

Roteamento por query string (`index.php?param=Controller/acao`) resolvido por um front
controller. As camadas são separadas manualmente:

```
generic/      # núcleo: autoload, front controller, factory e singleton de conexão
controller/   # recebe a requisição, chama o service e escolhe a view
service/      # regras de negócio e validações
dao/          # acesso ao banco via PDO (implementação MySQL)
template/     # montagem de HTML reaproveitável
public/       # views e assets
```

## Como rodar

1. Crie o banco importando `fitness.sql` (phpMyAdmin ou `mysql -u root fitness < fitness.sql`).
2. Ajuste usuário e senha do banco em `DatabaseConnection.php` se necessário (padrão: `root`
   sem senha).
3. Suba o servidor embutido a partir da raiz do projeto:

   ```bash
   php -S localhost:8000
   ```

4. Acesse `http://localhost:8000` — a rota padrão abre a tela de login.

## Equipe

Trabalho em grupo. Contribuições nas branches `DevKaiky` e `Miguel`.
