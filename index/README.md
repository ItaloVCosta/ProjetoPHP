Projeto escolhido: Cidadão de Olho

Autor: ítalo Vasconcelos Costa		
E-mail: italo.costa99@gmail.com

------------------------------------------------------Arquivos Necessários----------------------------------------------------------------------------------

	Antes de começar a discutir o projeto é de extrema importância que o usuário tenha a versão do PHP 8.1.1, que pode ser obtido em: 
					https://www.php.net/downloads
altere a php.ini localizada dentro da pasta do php e retire o ; de ;extension=pdo_sqlite, feito isso salve o arquivo.
	Para a realização dos itens solicitados no projeto foi utilizado o framework Laravel, sendo assim é necessário instala-lo, assim como o composer e 
inserir as variáveis no sistema. Link do download do composer:
					https://getcomposer.org/download/
	Após a instalação do composer é necessário, caso o Laravel não esteja instalado, digitar no cmd:
Composer global require laravel/installer
	Com os arquivos citados instalados, já é possível abrir o projeto que está localizado no github(https://github.com/ItaloVCosta/ProjetoPHP).
------------------------------------------------------Seleção dos Links da API da ALMG---------------------------------------------------------------------

	Previamente a programação do código, foi selecionado os links necessários da ALMG, são eles:
Deputados do mandato de 2019 (recebendo a relação de nome e ID)
		http://dadosabertos.almg.gov.br/ws/legislaturas/19/deputados/situacao/1?formato=json
Verbas indenizatórias (usado para obter os valores dos deputados que mais pediram reembolso em 2019, separado por mês)
		http://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/legislatura_atual/deputados/{id}/2019/{mes}?formato=json
Redes Sociais (se encontram no link por id de deputado):
		http://dadosabertos.almg.gov.br/ws/deputados/[id]?formato=json


------------------------------------------------------Softwares Utilizados------------------------------------------------------------------------------


	O projeto foi feito utilizando o editor de código VScode, além disso, para o teste do retorno do método GET da API utilizado o insomnia.
 Para a melhor visualização do banco de dados, o SQLiteStudio foi empregado.

-----------------------------------------------------Elaboração do Código--------------------------------------------------------------------------------

	Inicialmente foi criado na pasta de “WebService” o arquivo ALMG.php, sendo uma classe que faz a requisição para a API da ALMG utilizando
 o curl e retornado um array. Nessa classe se encontram 3 funções, uma para cada Link descrito em “Seleção dos Links da API da ALMG”.
	Com a comunicação com a API disponível foram trabalhados os dados em “index.php”( vendor\index.php) solicitados de forma a aparece a 
resposta desejada, por exemplo, para as redes sociais foi iterado as redes sociais de cada deputado e somado no array “usoDasRedes” e 
posteriormente organizado de forma decrescente. Já para a verba indenizatória foi feito a função “verbadosDeputados” que soma todos os pedidos 
de reembolso realizados no mês informado, retornando um vetor com id, nome do deputado e valor total pedido em reais, dos 5 deputados que mais 
gastaram.
	Por último foi enviado os dados para o banco de dados escolhido (SQLite), através das funções criadas no “enviaDado.php” que utiliza 
o PDO para pode registrar os conteúdos das tabelas.
	Para a estruturação da tabela foi criado as migrations “2022_01_17_183123_create_RedeSociais_table.php” e 
“2022_01_17_183258_create_VerbaIndenizatorias_table.php”.
	Na elaboração da API foram criados duas rotas que executam o método get, também foi criado o controller de cada solicitação 
(RedesSociais e VerbasIndenizadoria) que lista os dados de cada tabela da API.

---------------------------------------------------------Antes de Rodar o Código---------------------------------------------------------------------------------

	Antes de digitar o comando php index.php no cmd é necessário inserir alguns comandos para o perfeito funcionamento do código, são eles:
•	“php artisan migrate” para utilizar os arquivos localizados em migrations e criar a tabela no banco de dados “database.sqlite”, localizado em 
(database\database.sqlite). Detalhe importante, o banco de dados tem que estar vazio!
•	“php artisan serve” para iniciar o servidor o ser possíver fazer a solicitação GET através do insomnia.

---------------------------------------------------------Rodando o Programa---------------------------------------------------------------------------------

	Dado a restrição de tempo e o limitado conhecimento, ao rodar o programa o usuário terá que esperar um tempo considerável para rodar o programa, já que não 
foi utilizado assync e await para poder otimizar o processo de leitura de dados do API, sendo assim foram colocados delays entre as requisições, dessa forma 
tornando o programa lento, no PC que estou utilizando o código demorou cerca de 1060 segundos para rodar.
	 
	Após rodar o programa, os resultados já podem ser observados no banco de dados diretamente.Observa-se que em janeiro não foram registrado reembolsos, 
já que é início de mandado jan/2019, sendo assim o programa ordenou pelo nome. Para mais meses abra o banco de dados.

Para testar o funcionamento da API, utilizou-se o método GET:
•	http://127.0.0.1:8000/api/RedesSociais para obter o ranking de redes sociais
•	http://127.0.0.1:8000/api/VerbaIndenizatoria  para obter os top 5 deputados que mais pediram reembolso de verbas indenizatórias por mês em 2019.

Atenção ao valor do local Host pode variar.
