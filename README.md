# Cash Flow Comtroller Api DDD Laravel

Api de Gerenciamento de Fluxo de Caixa desenvolvida em Laravel/PHP com o Pradrão de Projeto DDD 

## Conteúdo do Projeto
O projeto contempla de serviços como: Adicionar Fluxo de Caixa,  Atualizar Fluxo de Caixa, Deletar Fluxo de Caixa, Localizar Fluxo de Caixa por Id e Localizar Todos Fluxos de Caixa por Data (Esse serviço é responsável de obter um consolidado diário ou entre um range de datas). 

## Contexto Delimitado
Este projeto é um contexto delimitado de fluxo de caixa, onde em novas versões, os dados dos funcionários e deparatamentos deste projeto serão alimentados por outro outro contexto delimitado, um projeto de RH através de mensageria que, por sua vez, será desenvolvido em um microserviço a parte em .Net.  

## Mapeamento dos Contextos

![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/context_mapping.png)

## Diagrama de Caso de Uso Adicionar Fluxo de Caixa
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/add_cash_flow_use_case_diagram.png)

## Descrição do Caso de Uso Adicionar Fluxo de Caixa
Este caso de uso permite que um usuário adicione um fluxo de caixa, podendo ser do tipo crédito ou débito;
### Atores:
Usuário do sistema.
### Pré condições:
o usuário deverá ser um funcionário.
### Pós Condições:
Fluxo de caixa registrado.
### Fluxo de Eventos:
### 1 - Fluxo Principal:
### P1 - 
O usuário envia para api dados pertinentes ao fluxo de caixa, como:
 description (Descrição);
 type[Credit, Debit] (Tipo (Credito ou Débito));
 value (Valor);
 note (Oberservação);
 movimentation_date (Data de movimentação);
 departament_id (Id do deparatamento);
 operation_type_id (Id do Tipo da Opração);
 employee_id (Id do Funcionário).

### P2 -
O serviço de aplicação (DelegateCashFlowAdd) delega ao serviço de dominio (GenrateIdentifier) a geração de um identifcador único do fluxo de caixa;
### P3 - 
O serviço de domínio (GenerateIdentifier) gera um identificador único e faz um merge com os dados da requisição (request), adicionando o valor do mesmo a uma key identifier;
### P4 - 
O serviço de aplicação (DelegateCashFlowAdd) delega ao serviço de domínio (AddCashFlow) a criação do Fluxo de caixa, que, por sua vez, antes solictar o registro ao repositório, solicita ao DTO o filtro e validação dos dados pertinentes ao Fluxo de Caixa; 
### P5 - 
O DTO filtra e valida os dados pertinentes ao fluxo de caixa e retorna pra o serviço de dominio (AddCashFlow), um array com os dados validados e prontos para sererm persistidos;
### P6 - 
O serviço de domínio (AddCashFlow) envia para o repositório os dados retornados pelo DTO para que sejam persistidos;
### P7 - 
O reposiório registra os dados pertinentes ao fluxo de caixa;
### P8 - 
O Serviço de Dominio (AddCashFlow) adiciona o id do fluxo de caixa registrado a key cash_flow_id para que seja validado e registardo futuramente como foreing key no registro do saldo na tabela cash_flow_balanses);
### P9 -
O serviço de aplicação (DelegateCashFlowAdd) delega ao serviço de domínio (AddCashFlowBalance) que adicione o saldo (Balance); 
### P7 - 
O serviço de dominio (AddCashFlowBalance) solicita ao repositório a adição do saldo do fluxo de caixa;
### P8 -
O reposiório registra os dados no banco de dados;  
### P9  -
O serviço de aplicação (DelegateCashFlowAdd) retorna uma mensagem de sucesso para o usuário.

### Fluxo de Exceção
### E1 -
O usuário envia para Api um ou varios dados inválidos pertinentes ao fluxo de caixa
### E2 -
Api retorna uma mensagem de erro informando o ocorido.

## Diagrama de Caso de Uso Atualizar Fluxo de Caixa
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/update_cah_flow_use_case_diagram.drawio.png)

## Descrição do Caso de Uso Atualizar Fluxo de Caixa
### Fluxo de Eventos:
### 1 - Fluxo Principal:
### P1 - 
O usuário envia para Api dados pertinentes ao fluxo de caixa, como:
 id (Id do fluxo de caixa )
 identifier (Identificador único do fluxo de caixa)
 description (Descrição);
 type[Credit, Debit] (Tipo (Credito ou Débito));
 value (Valor);
 note (Oberservação);
 movimentation_date (Data de movimentação);
 departament_id (Id do deparatamento);
 operation_type_id (Id do Tipo da Opração);
 employee_id (Id do Funcionário).
 cash_flow_balance {id, balance} .

### P2 - 
O serviço de aplicação (DelegateCashFlowUpdate) delega ao serviço de dominio (UpdateCashFlow) a atualização dos dados do Fluxo de caixa, que, por sua vez, antes solictar o registro da atulização, solicita ao DTO o filtro e validação dos dados pertinentes a atualização do fluxo de caixa; 
### P3 - 
O DTO filtra e valida os dados pertinentes à atualização do fluxo de caixa e retorna para o serviço de domínio (UpdateCashFlow) um array com os dados validados e prontos para sererm persistidos;
### P4 - 
O serviço de dominio (UpdateCashFlow) envia para o repositório os dados retornados pelo DTO para que sejam persistidos;
### P5 - 
O reposiório registra os dados pertinentes à atualização do fluxo de caixa;
### P6 -
O serviço de aplicação (DelegateCashFlowUpdate) delega ao serviço de domínio (UpdateCashFlowBalance) que atualize saldo; 
### P7 - 
O serviço de dominio (UpdateCashFlowBalance) solicita ao repositório à atualização do saldo;
### P8 -
O reposiório atualiza os dados do fluxo de caixa no banco de dados.  
### P9  -
O serviço de aplicação (DelegateCashFlowUpdate) retorna uma mensagem de sucesso para o usuário.

### Fluxo de Exceção
### E1 -
O usuário envia para Api um ou varios dados inválidos pertinentes ao fluxo de caixa
### E2 -
A Api retorna uma mensagem de erro informando o ocorrido.

## Diagrama de Caso de Uso Deletar Fluxo de Caixa
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/update_cah_flow_use_case_diagram.drawio.png)

## Descrição do Caso de Uso Deletar Fluxo de Caixa
### Fluxo de Eventos:
### 1 - Fluxo Principal:
### P1 - 
O usuário envia para Api o id do fluxo de caixa que deseja deletar
### P2 - 
O serviço de aplicação (DelegateCashFlowDelete) delega ao serviço de dominio (DeleteCashFlow) que delete o Fluxo de caixa pertinente ao id disponível na requisição (request), que, por sua vez, antes de solictar a exclução, solicita ao Value Objeto IdVO a validação do id  disponível na requisição (request); 
### P3 - 
O IdVO valida o id e fica disponivel para o serviço de dominio (DeleteCashFlow) enviá-lo para o repositório;
### P4 - 
O Serviço de Dominio (DeleteCashFlow) envia para o repositório o Value Object IdVO para exclução do fluxo de caixa pertinente ao id encapsulado no mesmo;
### P5 - 
O reposiório deleta o fluxo de caixa;
### P6 -
O serviço de aplicação (DelegateCashFlowDelete) retorna um mensagem de sucesso; 

### Fluxo de Exceção
### E1 -
O usuário envia para Api o id inválido do fluxo de caixa que deseja deletar
### E2 -
A Api retorna uma mensagem de erro informando o ocorido.

## Diagrama de Caso de Uso Localizar Fluxo de Caixa por Id
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/find_cash_flow_by_id.drawio.png)

## Descrição do Caso de Uso Localizar Fluxo de Caixa por Id
### P1
O usuário envia para Api o id do fluxo de caixa que deseja obeter
### P2 - 
O serviço de dominio (FindCashFlowById) solicita ao Value Objeto IdVO a validação do id disponível na requisição (request); 
### P3 - 
O IdVO valida o id e fica disponível pra o serviço de dominio (FindCashFlowById) enviá-lo para o repositório;
### P4 - 
O serviço de domínio (DeleteCashFlow) envia para o repositório o Value Object IdVO para obter o fluxo de caixa pertinente ao id encapsulado no mesmo;
### P5 - 
O reposiório localiza e retorna o fluxo de caixa;

### Fluxo de Exceção
### E1 -
O usuário envia para Api um id inválido do fluxo de caixa que deseja obter
### E2 -
A Api retorna uma mensagem de erro informando o ocorrido.

## Diagrama de Caso de Uso Localizar Todos Fluxos de Caixa por Data
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/find_all_cash_flow_by_date.drawio.png)

## Descrição do Caso de Uso Localizar Fluxo Todos de Caixa por data
### P1
O usuário envia para Api a initialDate (data inicial), finalDate (data final), o Type (tipo (Credito ou Débito)), a page (página para paginação) e limit (Limite de dados que virão por página);
### P2 - 
O serviço de dominio (FindAllCashFlowByDate) solicita ao Value Objeto DateVO a validação da data inicial (InitalDate) e a validação da data final (finalDate), e ao Value Objeto TypeVO a validação tipo (Type) disponível na requisição (request); 
### P3 - 
O TypeVo valida o Tipo (Type) e fica disponivel pra o serviço de dominio (FindAllCashFlowByDate) enviá-lo para o repositório;
### P3 - 
O DateVo valida a data inicial e a data final, e fica disponível pra o serviço de dominio (FindAllCashFlowByDate) enviá-lo para o repositório;
### P4 - 
O serviço de dominio (FindAllCashFlowByDate) envia para o repositório os Value Objects TypeVO, DateVo, page, limit;
### P5 - 
O reposiório retorna os fluxo de caixas;

### Fluxo de Exceção
### E1 -
O usuário envia para Api a data inicial (initialDate)invalida e/ou data final (finalDate) inválida e/ou tipo (type) inválido e/ou página (page) inválida para obeter os fluxos de caixa desejados
### E2 -
A Api retorna uma mensagem de erro informando o ocorrido.

### Fluxo de Alternativo
### A1
O usuário envia somente a data inicial e os demais parametros nulos (Data final (FinalDate), pagina (Page) e tipo (Type) para Api obeter todos os fluxos de caixa regitarados na data informada;
### A2 - 
O serviço de domínio (FindAllCashFlowByDate) solicita ao Value Objeto DateVO a validação da data inicial(InitialDate) e data final (FinalDate), e ao TypeVO a validação do type(tipo(Crédito ou Debito)) disponível na requisição (request); 
### A3 - 
O TypeVo ao verificar que o tipo (type) é nulo, adiona o valor 'all' a key type para obter tanto fluxos de caixa do tipo crédito quanto aos fluxos de caixa do tipo débito e fica disponível para o serviço de dominio (FindAllCashFlowByDate) enviá-lo para o repositório;
### A4 - 
O DateVo ao verificar que a data final é nula, adiciona o valor da data inicial (initialDate) na key data final (finalDate), disponível na requisição (request) e fica disponivel pra o serviço de dominio (FindAllCashFlowByDate) enviá-lo para o repositório;
### A5 - 
O serviço de dominio (FindAllCashFlowByDate) envia para o repositório os Value Objects TypeVO, DateVo, page e o limit ;
### P5 - 
O reposiório retorna os fluxo de caixas;

### Fluxo de Exceção
### E1 -
O usuário envia para Api a data inicial (initialDate) inválida e os demais parametros(data final (finalDate), tipo (type) e página (page)) nulos;
### E2 -
A Api retorna uma mensagem de erro informando o ocorido.

