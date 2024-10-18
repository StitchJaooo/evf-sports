# EVF Sports

**EVF Sports** é um site desenvolvido para exibir e vender produtos esportivos, focando em camisas personalizadas. O projeto utiliza tecnologias web modernas e bibliotecas especializadas para criar uma experiência fluida e dinâmica para os usuários.

## Índice

- [Recursos](#recursos)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Instalação](#instalação)
- [Configuração do Banco de Dados](#configuracao-do-banco-de-dados)
- [Administração](#administração)
- [Como Usar](#como-usar)

## Recursos

- Exibição dinâmica de produtos com redirecionamento para páginas detalhadas.
- Carrossel dos produtos registrados usando **slick-carousel**.
- Personalização de Logos com textos e formas através da integração com **Fabric.js**.
- Controles de cores ajustáveis para personalização.
- Modais dinâmicos utilizando **Bootstrap**.

## Tecnologias Utilizadas

- **HTML5** e **CSS3**: Estrutura e estilo da interface.
- **JavaScript (ES6)**: Manipulação de eventos e interatividade.
- **PHP**: Backend simples para gerenciamento das páginas de produtos.
- **MySQL**: Banco de dados para armazenar informações dos produtos e usuários.
- **Fabric.js**: Adição e personalização de textos e formas.
- **Slick-Carousel**: Plugin de carrossel para exibição dos produtos.
- **Bootstrap**: Framework de front-end para criar modais e facilitar a integração com o **Slick-Carousel**.
- **Git**: Controle de versão e colaboração.

## Instalação

1. Baixe e instale o [XAMPP](https://www.apachefriends.org/pt_br/index.html).

2. Clone o repositório para o diretório `htdocs` do XAMPP. No Windows, esse diretório normalmente está em `C:\xampp\htdocs\`:

    ```bash
    git clone https://github.com/StitchJaooo/evf-sports.git
    ```

3. Certifique-se de que o Apache está rodando no XAMPP. Abra o **Painel de Controle do XAMPP** e clique em "Start" no Apache.

4. Navegue até `http://localhost/evf-sports` no seu navegador para visualizar o site.

## Configuração do Banco de Dados

1. Certifique-se de que o MySQL está rodando no XAMPP. No **Painel de Controle do XAMPP**, clique em "Start" no MySQL.

2. Abra o **Shell** do XAMPP (disponível no painel de controle).

3. No shell, execute o seguinte comando para acessar o MySQL com o usuário root:

    ```bash
    mysql -u root
    ```

4. No shell do MySQL, copie e cole todo o conteúdo do arquivo `script-banco.txt` que está no repositório para criar o banco de dados:

    ```bash
    source script banco.txt;
    ```

    Isso criará o banco de dados necessário e suas tabelas.

5. Após concluir, o banco de dados estará configurado e pronto para uso com o site.

## Administração

O projeto inclui uma página de administração acessível em `adm.php`, que permite realizar operações CRUD na tabela de produtos:

- **Create**: Adicionar novos produtos ao sistema.
- **Read**: Visualizar todos os produtos cadastrados.
- **Update**: Editar informações de produtos existentes.
- **Delete**: Remover produtos do sistema.

Esta página é uma ferramenta importante para gerenciar o catálogo de produtos diretamente na base de dados.

## Como Usar

- Acesse a página principal para visualizar os produtos esportivos disponíveis.
- Navegue pelo **carrossel de camisas**, que utiliza o **Slick-Carousel** para exibir todas as opções de produtos contidas no banco de dados. O carrossel é interativo, permitindo que o usuário explore os produtos sem sair da página.
- Clique em um produto para acessar uma pagina que permite adicionar este produto ao seu carrinho.
- Para personalizar uma camisa, acesse a seção de personalização e adicione textos ou formas, ajustando as cores conforme desejado.
