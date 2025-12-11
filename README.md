Teaching Search

Plataforma de capacitação e conexão entre professores e escolas inclusivas.

<div align="center">

</div>
✨ Sobre o Projeto

O Teaching Search é uma plataforma web criada para apoiar professores que trabalham — ou desejam trabalhar — com alunos com deficiência. A aplicação oferece um ambiente simples e intuitivo onde educadores podem:

Acessar cursos de capacitação

Concluir certificações

Acompanhar seu progresso

Candidatar-se a vagas em escolas da rede inclusiva

Do outro lado, as escolas podem:

Cadastrar vagas

Acompanhar candidaturas

Encontrar professores certificados de acordo com suas necessidades

O sistema funciona como uma ponte entre profissionais capacitados e instituições de ensino, facilitando o processo de contratação e fortalecendo a inclusão escolar.

🧩 Tecnologias Utilizadas

Front-end:

HTML5

CSS3

JavaScript (ES6+)

Back-end:

PHP 8+

MySQL (phpMyAdmin)

Outros Recursos:

Sessões PHP para autenticação

Fetch API para comunicação assíncrona

Estrutura organizada por áreas públicas e restritas

🚀 Como Executar o Projeto
1. Clonar o repositório
git clone https://github.com/SEU-USUARIO/SEU-REPOSITORIO.git

2. Mover para servidor local

Coloque o projeto em:

htdocs (XAMPP)

www (WAMP)

Applications/MAMP/htdocs (MAMP)

3. Configurar o banco de dados

Abra o phpMyAdmin

Crie um banco (ex.: teaching_search)

Importe o arquivo .sql do projeto (caso exista)

4. Configurar a conexão

No arquivo conexao.php, ajuste:

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teaching_search";

5. Executar

Abra no navegador:

http://localhost/teaching-search/

📁 Estrutura do Projeto (resumo)
/public               → páginas acessíveis
/restrito             → áreas para professores e escolas
/assets               → CSS, imagens e scripts JS
/php                  → arquivos de lógica, autenticação e conexões
index.php             → página inicial

🖼️ Prévia da Interface

(Adicione imagens aqui quando quiser)

Exemplo:

![Tela Inicial](assets/img/tela_inicial.png)
![Dashboard](assets/img/dashboard_professor.png)

👥 Participantes

Amanda da Silva Freire
Valentina Lago Raad

