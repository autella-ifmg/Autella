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

- [ ] Delete


## Institution
- [ ] Create
	- [X] Ao criar instituição, inserir imagem padrão
		- [X] Fazer imagem padrão
		- [X] Mudar o createSQL.php
	- [ ] Campo CEP e email institucional
		- [X] GUI
		- [ ] SQL
	- [ ] Impedir instituições iguais	
	- [ ] Dar a opção de "Sou professor" na hora do cadastro, para coordenadores que não são professores -> perguntar para o kdú se isso existe
	- [ ] Transformar campo de estado em dropdown -> perguntar para o kdú se tem necessidade (criar tabelas no bd)
	- [ ] Transformar campo de cidade em dropdown -> perguntar para o kdú se tem necessidade (criar tabelas no bd)

- [ ] Read
	- [X] Foto -> Banner
	- [ ] Campo CEP e email institucional
		- [X] GUI
		- [ ] SQL

- [ ] Update
	- [ ] Usar CropperJS
	- [X] Foto -> Banner
	- [X] Apenas o coordenador da instituição pode alterar seus dados
	- [ ] Transformar campo de estado em dropdown -> perguntar para o kdú se tem necessidade (criar tabelas no bd)
	- [ ] Transformar campo de cidade em dropdown -> perguntar para o kdú se tem necessidade (criar tabelas no bd)
	- [ ] Impedir instituições iguais
	- [ ] Campo CEP e email institucional
		- [X] GUI
		- [ ] SQL

- [ ] Delete

## Question
- [ ] Create
	- [ ] Permitir a seleção de mais de uma matéria
 	- [ ] Travar o selectAC enquanto o selectQA ainda não tiver sido preenchido
- [ ] Update
	- [ ] Exibir mais de uma matéria
	- [ ] Edições na janela de visualização
	- [ ] Alterar id quando as disciplinas mudarem
	- [ ] Executar HTML dentro do CKEditor
	- [ ] Adicionar ícone para permitir edição
	- [ ] Adicionar paginação
	- [ ] Adicionar filtros de pesquisa
	- [ ] Exibir dificuldade da questão
- [ ] Help
	- [ ] Adicionar seções de ajuda

## Database

- [X] Criar tabela "Área" no banco de dados
- [X] Criar tabela "Disciplina" no banco de dados
- [X] Mudar de "professor" para "user"
- [X] Eliminar coluna de "picture" do usuário
- [X] Eliminar coluna de "picture" da instituição
- [ ] professor -> coluna de "último acesso em"
- [ ] professor -> coluna de status ("online", "offline", "conta desativada")

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

## Observações
	1 coordenador por escola
	professores dessa escola são subordinados a esse coordenador
	coordenadores tem página de gerenciamento dos professores                                               


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


## Possíveis novas funções
* Sistema de mensagens (tipo do moddle)
* Email de verificação de criação de contas
* Esqueci a senha
* Mudar Gerar PDF do Nicholas para o João
* Crud da instituição
* Versionamento de questões (tipo o do GitHub)
* Versionamento de provas (tipo o do GitHub)
* Painel de controle do coordenador
	* Desativar e alterar subordinados
	* Transferência de cargo
