## User
- [X] Create
	- [X] Alterar modal para arquivos próprios
	- [X] Dropdown de "Área"
	- [X] Dropdown de "Disciplina"
	- [X] Botão de cancelar
	- [X] Fazer campos de "Área" e "Disciplina" funcionarem
	- [X] Listar as áreas no banco de dados no dropdown
	- [X] Deixar os valores dos dropdowns acessíveis ao $_POST
	- [X] Pegar valores dos dropdowns para inserir na criação da conta
	- [X] Exibir somente disciplinas correspondentes à "Área" selecionada
	- [X] Pegar cargo do banco de dados
	- [X] Selecionar instituição
	- [X] Caixa de confirmar senha
	- [X] Usar CropperJS na atualização da imagem
	- [X] Mudar de "professor" para "user"
	- [X] Ao criar conta, inserir imagem padrão	
	- [X] Verificação de campos
		- [X] Vazios
		- [X] Campo de confirmar senha
		- [X] Impedir contas com o mesmo email
		- [X] Impedir mais de um coordenador por instituição
	
- [X] Update
	- [X] Alterar modal para arquivos próprios
	- [X] Caixa de confirmar senha
	- [X] Alterar e embelezar
	- [X] Permitir apenas o envio de imagens
	- [X] Preview da imagem
	- [X] Usar CropperJS
	- [X] Verificação de campos
		- [X] Vazios
		- [X] Campo de confirmar senha
		- [X] Impedir contas com o mesmo email

- [X] Read
	- [X] Fazer campos de "Área" e "Disciplina" funcionarem
	- [X] Impedir a exibição de contas do gerenciador do sistema
	- [X] Se a conta estiver desativada e não for o próprio usuário ou coordenador ou gerenciador do sistema que estiver acessando, mostrar "Essa conta foi desativada"
		- [X] Fazer função que pega o id do usuário e retorna o 'status' da conta
		- [X] Fazer função que retorna o id do coordenador da instituição do usuário


- [X] Desactivate
	- [ ] Activate


## Institution
- [X] Create
	- [X] Ao criar instituição, inserir imagem padrão
		- [X] Fazer imagem padrão
		- [X] Mudar o createSQL.php
	- [X] Campo CEP e email institucional
		- [X] GUI
		- [X] SQL

- [X] Read
	- [X] Foto -> Banner
	- [X] Campo CEP e email institucional
		- [X] GUI
		- [X] SQL

- [X] Update
	- [X] Usar CropperJS
	- [X] Foto -> Banner
	- [X] Apenas o coordenador da instituição pode alterar seus dados
	- [X] Campo CEP e email institucional
		- [X] GUI
		- [X] SQL

- [ ] Desactivate
	- [ ] Activate

## Question
- [ ] Geral
	- [X] Configurar ações do coordenador
	- [X] Deixar valores dos dropdowns pré-selecionados
	- [X] Remover selectAlternativesQuant
	- [X] Tratamento para inserção de apóstrofo
	- [X] Otimização de códigos
	- [ ] Otimização de importações
	- [ ] Tratamento para inserção de imagens
	- [ ] Responsividade
	- [ ] CKEditor Custom
	
- [ ] Create
	- [X] Configurar o toast de criação de questão
	- [ ] Permitir que os campos de alternativas também sejam formatados

- [ ] Read
	- [X] Adicionar paginação
	- [X] Adicionar filtros de pesquisa
	- [X] Adicionar opção "Escolha..." no selectDiscipline
	- [X] Exibir em quais provas simples a questão está presente
	- [X] Só mostrar paginação caso necessário
	- [ ] Exibir quem criou a questão
	- [ ] Mostrar quais filtros foram aplicados
 	
- [X] Update
	- [X] Configurar o toast de alteração de questão

- [X] Archive
	- [X] Arquivar questão
	- [X] Listar quetões arquivadas
	- [X] Desarquivar questão
	- [X] Configurar o toast de arquivamento de questão

- [X] Delete
	- [X] Deletar questão
	- [X] Listar quetões deletadas
	- [X] Restaurar questão
	- [X] Configurar o toast de exclusão de questão

- [ ] Help

## Painel de controle do coordenador
- [X] Tabela de visualização dos dados
- [X] Botão de visualizar funcionando
- [ ] Página de edição personalizada, para editar qualquer atributo de um usuário
- [ ] Transformar cruds/user/delete para pegar "$_GET" e não "$_SESSION['userData']['id']"
- [ ] Barra de pesquisa de nome de usuário
- [ ] Log (Ex.: Usuário tal fez tal coisa em tal data; Tal questão foi alterada; Tal prova foi criada)
- [ ] Criação de usuários

## Painel de controle do gerenciador do sistema
- [ ] Coisas do painel de controle do coordenador
- [ ] Coisas do painel de controle do coordenador, mas adaptadas para instituições

## Database

- [X] Criar tabela "Área" no banco de dados
- [X] Criar tabela "Disciplina" no banco de dados
- [X] Mudar de "professor" para "user"
- [X] Eliminar coluna de "picture" do usuário
- [X] Eliminar coluna de "picture" da instituição
- [X] Criar coluna de CEP e email na instituição
- [X] Remover coluna de id_discipline e correctAnswerEnunciate na tabela question
- [X] user -> coluna de status ("conta ativa", "conta inativa")
- [X] institution -> coluna de status ("instituição ativa", "instituição inativa")

## Geral
- [X] Redirecionar da homepage para outras páginas quando cadastrado
- [X] Inserir imagem e opções de usuário na navbar
- [ ] Tela de apresentação do site (Tela inicial)
- [ ] Carousel de usuários (visualizar professores e coordenadores; mexe sozinho)
- [ ] Carousel de instituições
- [ ] Carousel de opiniões (mexe sozinho)
- [ ] Sobre nós
- [ ] Toasts de mensagens

## Segurança
- [ ] Tirar senha do $_SESSION['userData'] -> implicações no professor/updateSQL.php
- [ ] Criptografia de senhas
- [ ] Desativar tags "<script>" e "<?php" do que o CkEditor retorna
- [ ] Segurança das demais abas (para implementar no "utilities/security.php". Exemplo demonstrado no "cruds/user/readGUI.php");

## Observações
	1 coordenador por escola
	professores dessa escola são subordinados a esse coordenador
	coordenadores tem página de gerenciamento dos professores
	somente programadores podem criar instituições e coordenadores
	somente coordenadores podem criar professores


## Dicas
* Use die() se não achou $_GET
* Quando as imagens não estiverem atualizando, pode ser que o navegador esteja guardando-as em cache.
Para evitar isso, faça o seguinte: adicione "?1222259157.415" no final do src da imagem, onde "1222259157.415" é o horário do servidor. Ex.: <img src="picture.jpg?1222259157.415" alt="">
A função de tempo no php é "time()", então ficaria <img src="/images/users/2.jpeg<?php echo '?' . time() ?>" />
* <script> be included between the <head> tags in your HTML document.
* $connection->close();		após		require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/...';


## Possíveis novas funções
* Sistema de mensagens (tipo do moddle)
* Email de verificação de criação de contas
* Esqueci a senha
* Versionamento de provas e questões (tipo o do GitHub)
* Comentário das questões
