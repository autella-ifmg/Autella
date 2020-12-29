## User
- [ ] Create
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
	- [ ] Só permitir o coordenador da instituição criar professores
	
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

- [X] Delete


## Institution
- [ ] Create
	- [X] Ao criar instituição, inserir imagem padrão
		- [X] Fazer imagem padrão
		- [X] Mudar o createSQL.php
	- [X] Campo CEP e email institucional
		- [X] GUI
		- [X] SQL
	- [ ] Só permitir o gerenciador do site criar instituições

- [X] Read
	- [X] Foto -> Banner
	- [X] Campo CEP e email institucional
		- [X] GUI
		- [X] SQL

- [ ] Update
	- [X] Usar CropperJS
	- [X] Foto -> Banner
	- [X] Apenas o coordenador da instituição pode alterar seus dados
	- [ ] Permitir alteração em qualquer instituição, para o gerenciador do site
	- [X] Campo CEP e email institucional
		- [X] GUI
		- [X] SQL

- [ ] Delete

## Question
- [ ] Geral
	- [X] Configurar ações do coordenador
	- [X] Deixar valores dos dropdowns pré-selecionados
	- [X] Remover selectAlternativesQuant
	- [X] Tratamento para inserção de apóstrofo
	- [X] Otimização de códigos
	- [ ] Responsividade
	- [ ] Nos selectSubjects, permitir que mais de um item possa ser selecionado
	- [ ] Validação required no CKEditor
	- [ ] CKEditor Custom
	- [ ] Tratamento para inserção de imagens

- [ ] Create
	- [X] Configurar o toast de criação de questão
	- [ ] Permitir que os campos de alternativas também sejam formatados

- [ ] Read
	- [X] Adicionar paginação
	- [X] Adicionar filtros de pesquisa
	- [X] Adicionar opção "Escolha..." no selectDiscipline
	- [ ] Exibir em quais provas a questão está presente
	- [ ] Exibir mais de uma matéria
	- [ ] Exibir quem criou a questão
	- [ ] Mostrar quais filtros foram aplicados
	- [ ] Só mostrar paginação caso necessário
 	
- [X] Update
	- [X] Configurar o toast de alteração de questão

- [ ] Archive
	- [X] Arquivar questão
	- [X] Listar quetões arquivadas
	- [X] Desarquivar questão
	- [X] Configurar o toast de arquivamento de questão

- [ ] Delete
	- [X] Deletar questão
	- [X] Listar quetões deletadas
	- [X] Restaurar questão
	- [X] Configurar o toast de exclusão de questão

- [ ] Help

## Painel de controle do coordenador
- [ ] Users
	- [X] Tabela de visualização dos dados
	- [X] Botão de visualizar funcionando
	- [ ] Botão de editar funcionando
	- [ ] Botão de excluir funcionando
	- [ ] Desativar e alterar subordinados
	- [ ] Transferência de cargo
- [ ] Barra de pesquisa
	
## Painel de controle do gerenciador do sistema
- [ ] Log (Ex.: Usuário tal fez tal coisa em tal data; Tal instituição foi criada; Tal questão foi alterada)
- [ ] Barra de pesquisa

## Database

- [X] Criar tabela "Área" no banco de dados
- [X] Criar tabela "Disciplina" no banco de dados
- [X] Mudar de "professor" para "user"
- [X] Eliminar coluna de "picture" do usuário
- [X] Eliminar coluna de "picture" da instituição
- [X] Criar coluna de CEP e email na instituição
- [ ] Remover coluna de id_discipline e correctAnswerEnunciate na tabela question
- [ ] user -> coluna de "último acesso em"
- [ ] user/institution -> coluna de status ("conta/instituição ativa", "conta/instituição inativa")

## Geral
- [X] Redirecionar da homepage para outras páginas quando cadastrado
- [X] Inserir imagem e opções de usuário na navbar
- [ ] Alterar funcionalidades da Navbar dependendo do cargo
- [ ] Tela de apresentação do site (Tela inicial)
- [ ] Carousel de usuários (visualizar professores e coordenadores; mexe sozinho)
- [ ] Carousel de instituições
- [ ] Carousel de opiniões (mexe sozinho)
- [ ] Sobre nós
- [ ] Segurança das demais abas (caso um usuário não cadastrado tente acessar uma página proibida; die() // Garante que nada abaixo será executado)
- [ ] Exibir ao usuário informações importantes do console
- [ ] Tabela de instituição (coordenador é responsável por administrar a página da instituição)

## Segurança
- [ ] Tirar senha do $_SESSION['userData'] -> implicações no professor/updateSQL.php
- [ ] Criptografia de senhas
- [ ] Desativar tags "<script>" e "<?php" do que o CkEditor retorna
- [ ] Verificar, no início de cada página, as possibilidades de erro 403 ou 404

## Observações
	1 coordenador por escola
	professores dessa escola são subordinados a esse coordenador
	coordenadores tem página de gerenciamento dos professores
	somente programadores podem criar instituições e coordenadores
	somente coordenadores podem criar professores


## Dicas
	* Use die() se não achou $_GET
	* enctype="multipart/form-data" -> atributo necessário em <form> caso envolva envio de imagens
	* Quando as imagens não estiverem atualizando, pode ser que o navegador esteja guardando-as em cache.
	Para evitar isso, faça o seguinte: adicione "?1222259157.415" no final do src da imagem, onde "1222259157.415" é o horário do servidor. Ex.: <img src="picture.jpg?1222259157.415" alt="">
	A função de tempo no php é "time()", então ficaria <img src="/images/users/2.jpeg<?php echo '?' . time() ?>" />
	*index.php com 403 em todas as pastas para evitar acessos indevidos
	*if($_Session['userData']['status'] == 2){
		$otherProfileName = 'Conta desativada';
	} else {
		$otherProfileName = array['name'];
	}
	* This script tag should be included between the <head> tags in your HTML document.
	*$connection->close();		após		require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect.php';


## Possíveis novas funções
* Sistema de mensagens (tipo do moddle)
* Email de verificação de criação de contas
* Esqueci a senha
* Versionamento de provas e questões (tipo o do GitHub)
* Comentário das questões
