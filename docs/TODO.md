## Após Login
- [X] Redirecionar da homepage para outras páginas quando cadastrado
- [X] Inserir imagem e opções de usuário na navbar
- [X] Alterar e embelezar /professor/update.php
- [X] Tela de visualizar dados
- [X] Preview da imagem a ser atualizada no /professor/update.php
- [X] Permitir apenas o envio de imagens no atualizar perfil
- [X] Verificação de campos ao modificar dados
- [X] Impedir contas com o mesmo email
- [ ] Desativar conta



## Cadastro
- [X] Alterar modal's para arquivos próprios
- [X] Ao criar conta, inserir imagem padrão
- [X] Dropdown de "Área"
- [X] Dropdown de "Disciplina"
- [X] Botão de cancelar
- [X] Criar tabela "Área" no banco de dados
- [X] Criar tabela "Disciplina" no banco de dados
- [X] Fazer campos de "Área" e "Disciplina" na página de criar conta funcionarem
- [X] Listar as áreas no banco de dados no dropdown
- [X] Deixar os valores dos dropdowns acessíveis ao $_POST
- [X] Pegar valores dos dropdowns para inserir na criação da conta
- [X] Exibir somente disciplinas correspondentes à "Área" selecionada
- [X] Fazer campos de "Área" e "Disciplina" na página de visualizar conta funcionarem
- [X] Caixa de confirmar senha
- [X] Embelezar /professor/create.php
- [X] Verificação de campos ao criar conta
- [X] Impedir contas com o mesmo email
- [X] Pegar cargo do banco de dados
- [X] Distinguir login/cadastro de professor/coordenador
- [X] Selecionar instituição
- [X] Responsividade dropdown's
- [ ] Institution CRUD
- [ ] Impedir mais de um coordenador por instituição

## Instituição
- [ ] Campo CEP
- [ ] Campo email institucional
- [ ] Transformar campo de estado em dropdown
- [ ] Transformar campo de cidade em dropdown
- [ ] Impedir criação de instituições iguais



## Geral
- [X] Transformar toast's em modal's
- [ ] Alterar funcionalidades da Navbar dependendo do cargo
- [ ] Tela de apresentação do site (Tela inicial)
- [ ] Carousel de usuários (visualizar professores e coordenadores; mexe sozinho)
- [ ] Carousel de opiniões (mexe sozinho)
- [ ] Sobre nós
- [ ] Segurança das demais abas (caso um usuário não cadastrado tente acessar uma página proibida; die() // Garante que nada abaixo será executado)
- [ ] Exibir ao usuário informações importantes do console
- [ ] Tabela de instituição (coordenador é responsável por administrar a página da instituição)

## Segurança
- [ ] Tirar senha do $_SESSION['userData'] -> implicações no professor/update.php
- [ ] Criptografia de senhas
- [ ] Validação de campos 
- [ ] Limpar variáveis
- [ ] Verificação de variáveis

## Observações
	1 coordenador por escola
	professores dessa escola são subordinados a esse coordenador
	coordenadores tem página de gerenciamento dos professores                                               
	use die() se não achou $_GET

## Possíveis novas funções
* Sistema de mensagens (tipo do moddle)
* Painel de controle do coordenador
	* Desativar e alterar subordinados
	* Transferência de cargo
* Email de verificação de criação de contas
* Esqueci a senha
* Mudar Gerar PDF do Nicholas para o João
* Crud da instituição
