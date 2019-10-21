# Desafio21
Desafio21 da P21 Sistemas

Sobre o Sistema:
Sistema anoreg foi feito para ajudar vida da secretaria que ficara responsável pela gestão de dados dos cartórios do Brasil.
A partir do arquivo XML que recebe mensalmente do CNJ, a funcionária conseguirar fazer o upload do propio arquivo no sistema, e este fará a inserção ou a atualização dos dados automaticamente.É possível atualizar a base existente no sistema utilizando a planilha excel(xlsx) que contem os dados atualiados do cartório. O sistema também permite o cadastro e edição de dados manuais, alem de gerar relatórios,mandar email para todos os cartórios registrados e criar novos usuários.

Requisitos para rodar sistema:
- PHP >= 7.2.7 
- Habilitar Url Amigaveis (ler mais : http://www.rafaelwendel.com/2011/08/como-usar-url-amigaveis-no-servidor-apache/)
- Banco mysql
-(Recomendado xampp pois ja tem php+mysql)

Explicações sobre o Framework própio:
Sistema Baseado na arquitetura MVC com orientação a objeto utilizando url amigaveis. Framework se baseia no gerenciamento de módulos e views para acessar as páginas.

Passo a Passo para iniciar o Sitema:
1º Crie uma base no mysql com o nome 'anoreg'.
2º Suba o arquivo anoreg.sql que se encontra na raiz do projeto para criar as tabelas.
3º As configurações do projeto encontram-se no caminho application/config.php caso queira alterar algo.
4º Coloque o projeto dentro da pasta htdocs caso esteja rodando pelo xampp ou wampp
5º Acesse o link local, e se tudo estiver correto, será redirecionado para página de Login.

Fluxo sistema:
1º Acessar a pagína de login e entrar no sistema com o usuario: Samuel.santos e senha:04876985170cruz (único usário criado no projeto).
2º A página principal mostra um gráfico mapa de cartórios por estado,onde clicando no estado, será redirecionado para uma página de relatório por estado.
3º O menu é divido em dois modulos: Cartório e Administrador
-Cartório: Resposável pelas funções de alimentação da base
-Administrador: Resposável por gerir as configurações do Framework e inserir novos usuários
4º No menu Cartório>Upload Arquivo Cartório, suba o arquivo xml que se encontra na raiz do projeto para fazer a alimentação inicial. Após a conclusão será redirecionado para a pagina de listagem de cartório.
5º Na listagem de cartório é possível Ver todos os cartórios cadastrados no sistema, sendo possível inativar ou editar um cartório.
6º Após a visualização dos dados, vá para cartório>Atualiza cartório Excel e suba o arquivo xlsx que se encontra na raiz do projeto, para atualizar os dados.
7º Após a atualização dos dados voltará para as listagem de cartórios, agora com os dados telefone e email atualizados, mude o email dos primeiros cartórios para o seu pessoal, para fazer o teste da função logo à frente.
8º Volte para Home e veja o mapa atualizado com os cartórios agora disponíveis.
9º No Menu> Enviar Email, é póssivel enviar um email para todo os cartórios registrados no sistema,o envio pode ser demorado dependendo do numero de cartórios ativos.

Após todos os passos, terá feito o fluxo principal do sistema.

Na parte Administrativa, é possível criar seu própio login em Administrador>Controle de Usuários.



