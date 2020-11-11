## User
- [ ] Create
	- [X] Alterar modal para arquivos próprios
	- [X] Ao criar conta, inserir imagem padrão	
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
	- [ ] Impedir mais de um coordenador por instituição
	- [ ] Verificação de campos
		- [X] Vazios
		- [ ] Campo de confirmar senha
		- [X] Impedir contas com o mesmo email
	
- [ ] Update
	- [X] Alterar modal para arquivos próprios
	- [X] Caixa de confirmar senha
	- [X] Alterar e embelezar
	- [X] Permitir apenas o envio de imagens
	- [X] Preview da imagem
	- [ ] Impedir mais de um coordenador por instituição
	- [ ] Verificação de campos
		- [X] Vazios
		- [ ] Campo de confirmar senha
		- [ ] Impedir contas com o mesmo email

- [X] Read
	- [X] Fazer campos de "Área" e "Disciplina" funcionarem

- [ ] Delete


## Institution
- [X] Create
	- [ ] Foto -> Banner
	- [ ] Dar a opção de "Sou professor" na hora do cadastro, para coordenadores que não são professores -> perguntar para o kdú se isso existe
	- [ ] Transformar campo de estado em dropdown
	- [ ] Transformar campo de cidade em dropdown	
	- [ ] Campo CEP
	- [ ] Campo email institucional
	- [ ] Impedir instituições iguais	
- [X] Read
	- [ ] Foto -> Banner
- [X] Update
	- [X] Apenas o coordenador da instituição pode alterar seus dados
	- [ ] Foto -> Banner
	- [ ] Transformar campo de estado em dropdown
	- [ ] Transformar campo de cidade em dropdown
	- [ ] Campo CEP
	- [ ] Campo email institucional
	- [ ] Impedir instituições iguais
- [ ] Delete


## Database

- [X] Criar tabela "Área" no banco de dados
- [X] Criar tabela "Disciplina" no banco de dado
- [ ] Mudar de "professor" para "user"
- [ ] professor -> coluna de "último acesso em"
- [ ] professor -> coluna de status ("online", "offline", "conta desativada")
- [ ] substituir 'picture' por 'image' no user e institution


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
- [ ] Tirar senha do $_SESSION['userData'] -> implicações no professor/update.php
- [ ] Criptografia de senhas

## Observações
	1 coordenador por escola
	professores dessa escola são subordinados a esse coordenador
	coordenadores tem página de gerenciamento dos professores                                               
	use die() se não achou $_GET
	enctype="multipart/form-data" -> atributo necessário em <form> caso envolva envio de imagens

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
