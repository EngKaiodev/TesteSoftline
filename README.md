# Teste Técnico DEV - Sistema de Cadastro

Este é um projeto desenvolvido como parte de um teste técnico para processo seletivo. Consiste em um sistema web simples com cadastro de produtos, clientes e usuários, utilizando PHP puro e MySQL.

## Funcionalidades

- **Login e Cadastro de Usuários**: Permite criar uma nova conta e fazer login no sistema.
- **Módulo de Produtos**: Listagem, cadastro, edição, visualização e exclusão de produtos.
- **Módulo de Clientes**: Listagem, cadastro, edição, visualização e exclusão de clientes.
- **Máscaras JavaScript**: Campos de documento (CPF/CNPJ) com formatação automática.
- **Design Responsivo**: Interface adaptável para dispositivos móveis.

## Tecnologias Utilizadas

- **Back-end**: PHP (puro, sem frameworks)
- **Banco de Dados**: MySQL
- **Front-end**: HTML5, CSS3, JavaScript (máscaras e interações)
- **Servidor Local**: Recomendado XAMPP ou PHP embutido

## Pré-requisitos

- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Servidor web local (XAMPP, WAMP, ou o servidor embutido do PHP)
- Navegador web atualizado

## Instalação e Configuração

### 1. Clone o repositório
```bash
git clone https://github.com/seu-usuario/teste-tecnico.git

2. Configure o banco de dados
Crie um banco de dados chamado testedev (ou outro nome de sua preferência).

Importe o arquivo tabela bd.txt localizado na raiz do projeto para criar as tabelas necessárias.

O arquivo contém a estrutura das tabelas Usuarios, Produtos e Clientes.

3. Configure a conexão com o banco
Edite o arquivo includes/config.php e ajuste as credenciais do MySQL conforme seu ambiente:

$host = 'localhost';
$dbname = 'testedev';
$username = 'root';   // seu usuário do MySQL
$password = '';       // sua senha do MySQL

4. Execute o projeto
Opção A: Com XAMPP (ou similar)
Coloque a pasta do projeto dentro do diretório htdocs do XAMPP.

Acesse http://localhost/teste-tecnico no navegador.

Opção B: Com o servidor embutido do PHP
Abra o terminal na raiz do projeto e execute:

php -S localhost:8000

Como Usar
Na página inicial, clique em Cadastre-se aqui para criar um novo usuário.

Informe um nome de usuário (mínimo 4 caracteres) e senha (mínimo 6 caracteres).

Após o cadastro, faça login com as credenciais criadas.

No menu principal, acesse os módulos de Produtos ou Clientes.

Utilize os botões para cadastrar, editar, visualizar ou excluir registros.

Estrutura de Pastas

teste-tecnico/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       ├── script.js
│       └── mascaras.js
├── includes/
│   ├── auth.php
│   ├── config.php
│   ├── footer.php
│   └── header.php
├── modules/
│   ├── clientes/
│   │   ├── cadastrar.php
│   │   ├── deletar.php
│   │   ├── editar.php
│   │   ├── listar.php
│   │   └── visualizar.php
│   ├── produtos/
│   │   ├── cadastrar.php
│   │   ├── deletar.php
│   │   ├── editar.php
│   │   ├── listar.php
│   │   └── visualizar.php
│   └── usuarios/
│       └── cadastrar.php
├── index.php
├── login.php
├── logout.php
├── menu.php
└── tabela bd.txt


