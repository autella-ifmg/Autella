## Login / Cadastro
- [X] Redirecionar da homepage para outras páginas quando cadastrado
- [X] Ao criar conta, inserir imagem padrão
- [X] Inserir imagem e opções de usuário na navbar
- [X] Alterar modal's para arquivos próprios
- [X] Embelezar /professor/create.php
- [X] Alterar e embelezar /professor/update.php
- [X] Tela de visualizar dados
- [X] Caixa de confirmar senha
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
- [ ] Distinguir login/cadastro de professor/coordenador
- [ ] Tela de visualizar todos os usuários
- [ ] Tela de desativar conta
- [ ] Validação de campos 
- [ ] Redimensionar todas imagens de perfil para 256x256
- [ ] Esqueci a senha
- [ ] Email de verificação de criação de contas
- [ ] Limpar e fazer verificação de variáveis
- [ ] Criptografia de senhas
- [ ] Impedir criação de contas com o mesmo email
- [ ] Tirar senha do $_SESSION['userData'] -> implicações no professor/update.php
- [ ] Verificar se o arquivo enviado pelo usuario é uma imagem
- [ ] Arrumar possíveis baguncinhas que o usuario pode fazer na hora de usar o site (catch's)




## Geral
- [X] Transformar toast's em modal's
- [ ] Tela de apresentação do site (Tela inicial)
- [ ] Carousel de usuários (visualizar professores e coordenadores; mexe sozinho)
- [ ] Carousel de opiniões (mexe sozinho)
- [ ] Sobre nós
- [ ] Segurança das demais abas (caso um usuário não cadastrado tente acessar uma página proibida; die() // Garante que nada abaixo será executado)

## Possíveis novas funções
	Sistema de mensagens (tipo do moddle)
	Painel de controle do coordenador


## Observações
	1 coordenador por escola
	professores dessa escola são subordinados a esse coordenador
	coordenadores tem página de gerenciamento dos professores                                               
	use die() se não achou $_GET
