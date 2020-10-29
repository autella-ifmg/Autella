## Login / Cadastro
- [X] Redirecionar da homepage para outras páginas quando cadastrado
- [X] Ao criar conta, inserir imagem padrao
- [X] Inserir coisas do usuário (imagem e opções de usuário) na navbar
- [X] Alterar modal's para arquivos próprios
- [X] Embelezar /professor/create.php
- [X] Alterar e embelezar /professor/update.php
- [X] Tela de visualizar dados
- [X] Caixa de confirmar senha
- [X] Dropdown de "Área"
- [X] Dropdown de "Disciplina"
- [X] Botão de cancelar

### Próxima entrega (Não feito)
	- [ ] Criar tabela "Área" no banco de dados
	- [ ] Criar tabela "Disciplina" no banco de dados
	- [ ] Fazer campos de "Área" e "Disciplina" na página de criar conta funcionarem
	- [ ] Fazer campos de "Área" e "Disciplina" na página de visualizar conta funcionarem

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
