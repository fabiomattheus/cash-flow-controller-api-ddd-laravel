# Cash Flow Comtroller Api DDD Laravel

Api de Gerencimanto de Fluxo de Caixa desenvolvida Larvel/PHP com o Pradrão de Projeto DDD 

## Conteúdo do Projeto
O projeto contempla de serviços como: Adicionar Fluxo de Caixa,  atualizar Fluxo de Caixa, Deletar Fluxo de Caixa, Localizar Fluxo de Caixa por Id e Localizar Todos Fluxos de caixa por Data (Esse serviço é responsável de mostrar um consolidado diario ou entre um range de datas). 

## Contexto Delimitado
Este projeto é um contexto delimitado de fluxo de caixa, onde em novas versões, os dados dos funcionários e deparatamentos serão alimentados por outro projeto de Rh em outo contexto delimitado através de mensageria que, por sua vez, será desenvolvido em um microserviço a parte em .Net.  

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
O serviço de aplicação(DelegateCashFlowAdd) delega ao serviço de dominio (GenrateIdentifier) a geração de um identifcador único do fluxo de caixa;
### P3 - 
O Serviço de Dominio (GenerateIdentifier) gera um código único e faz um merge do mesmo com os dados da requisição;
### P4 - 
O serviço de aplicação (DelegateCashFlowAdd) delega ao serviço de dominio (AddCashFlow) a criação do Fluxo de caixa, que, por sua vez, antes solictar o registro, solicita ao DTO o filtro e validação dos dados pertinentes ao Fluxo de Caixa; 
### P5 - 
O DTO filtra e valida os dados pertinentes ao fluxo de caixa e retorna pra o serviço de dominio (AddCashFlow) um array com os dados validados e pronto para sererm persistidos;
### p6 - 
O Serviço de Dominio (AddCashFlow) envia para o repositório os dados retornados pelo DTO para que sejam persistidos;
### P7 - 
O reposiório registra os dados pertinentes ao fluxo de caixa;
### P8 -
O serviço de aplicação (DelegateCashFlowAdd) delega ao serviço de dominio (AddCashFlowBalance) que atualize saldo; 
### P7 - 
serviço de dominio (AddCashFlowBalance) solicita ao repositório a atualização do saldo de acordo com o tipo (Crédito ou Debito)
### P8 -
O reposiório registra os dados no banco de dados a saldo do fluxo de caixa.  
### P9  -
O serviço de aplicação retorna um mensagem de sucesso para o usuário.

### Fluxo de Exceção

### E1 -
O usuário envia para api um ou varios dados inválidos pertinentes ao fluxo de caixa
### E2 -
Api retorna uma mensagem de erro informando o ocorido.

## Diagrama de Caso de Uso Atualizar Fluxo de Caixa
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/update_cah_flow_use_case_diagram.drawio.png)

## Descrição do Caso de Uso Atualizar Fluxo de Caixa
### Fluxo de Eventos:
### 1 - Fluxo Principal:
### P1 - 
O usuário envia para api dados pertinentes ao fluxo de caixa, como:
 id (Id do Fluxo de Caixa )
 identifier (Identificador)
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
O serviço de aplicação (DelegateCashFlowAdd) delega ao serviço de dominio (UpdateCashFlow) a atualização do Fluxo de caixa, que, por sua vez, antes solictar o registro da atulização, solicita ao DTO o filtro e validação dos dados pertinentes a atualização do Fluxo de Caixa; 
### P3 - 
O DTO filtra e valida os dados pertinentes a atualização do fluxo de caixa e retorna pra o serviço de dominio (UpdateCashFlow) um array com os dados validados e prontos para sererm persistidos;
### P4 - 
O Serviço de Dominio (UpdateCashFlow) envia para o repositório os dados retornados pelo DTO para que sejam persistidos;
### P5 - 
O reposiório registra os dados pertinentes a atualização fluxo de caixa;
### P6 -
O serviço de aplicação (DelegateCashFlowAdd) delega ao serviço de dominio (UpdateCashFlowBalance) que atualize saldo; 
### P7 - 
serviço de dominio (UpdateCashFlowBalance) solicita ao repositório a atualização do saldo de acordo com o tipo (Crédito ou Debito)
### P8 -
O reposiório registra os dados atualizado no banco de dados.  
### P9  -
O serviço de aplicação retorna um mensagem de sucesso para o usuário.

### Fluxo de Exceção

### E1 -
O usuário envia para api um ou varios dados inválidos pertinentes ao fluxo de caixa
### E2 -
Api retorna uma mensagem de erro informando o ocorido.

## Diagrama de Caso de Uso Deletar Fluxo de Caixa
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/update_cah_flow_use_case_diagram.drawio.png)

## Descrição do Caso de Uso Deletar Fluxo de Caixa
## Descrição do Caso de Uso Atualizar Fluxo de Caixa
### Fluxo de Eventos:
### 1 - Fluxo Principal:
### P1 - 
O usuário envia para Api o id do fluxo de caixa que deseja deletar
### P2 - 
O serviço de aplicação (DelegateCashFlowDelete) delega ao serviço de dominio (DeleteCashFlow) que delete o Fluxo de caixa pertinente ao id disponível na requisição (request), que, por sua vez, antes solictar a exclução, solicita ao Value Objeto IdVO a validação do id ; 
### P3 - 
O IdVo valida o Id e fica disponivel pra o serviço de dominio (DeleteCashFlow) enviá-lo para o repositório;
### P4 - 
O Serviço de Dominio (DeleteCashFlow) envia para o repositório o Value Object IdVO para exclução do Fluxo de Caixa pertinente ao Id;
### P5 - 
O reposiório deleta o fluxo de caixa;
### P6 -
O serviço de aplicação (DelegateCashFlowDelete) retorna um mensage de sucesso; 

### Fluxo de Exceção
### E1 -
O usuário envia para Api o id inválido do fluxo de caixa que deseja deletar
### E2 -
Api retorna uma mensagem de erro informando o ocorido.

## Diagrama de Caso de Uso Localizar Fluxo de Caixa por Id
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/find_cash_flow_by_id.drawio.png)

## Descrição do Caso de Uso Localizar Fluxo de Caixa por Id
### P1
O usuário envia para Api o id do fluxo de caixa que deseja obeter
### P2 - 
O serviço de dominio (FindCashFlowById) solicita ao Value Objeto IdVO a validação do id disponível na requisição (request) ; 
### P3 - 
O IdVo valida o Id e fica disponivel pra o serviço de dominio (DeleteCashFlow) enviá-lo para o repositório;
### P4 - 
O serviço de dominio (DeleteCashFlow) envia para o repositório o Value Object IdVO para exclução do Fluxo de Caixa pertinente ao Id encapsulado no mesmo;
### P5 - 
O reposiório localiza e retorna o fluxo de caixa;

### Fluxo de Exceção
### E1 -
O usuário envia para Api o id inválido do fluxo de caixa que deseja obter
### E2 -
Api retorna uma mensagem de erro informando o ocorido.

## Diagrama de Caso de Uso Localizar Todos Fluxos de Caixa por Data
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/find_all_cash_flow_by_date.drawio.png)

## Descrição do Caso de Uso Localizar Fluxo Todos de Caixa por data
### P1
O usuário envia para Api a data inicial, data Final e o tipo (Credito ou Débito) para obeter todos o fluxos de caixa regitarado entre a data inicial à data final e o tipo;
### P2 - 
O serviço de dominio (FindAllCashFlowByDate) solicita ao Value Objeto DateVO e TypeVO a validação da data inicial, data final e o tipo(Crédito ou Debito) disponível na requisição (request); 
### P3 - 
O TypeVo valida o Id e fica disponivel pra o serviço de dominio (FindAllCashFlowByDate) enviá-lo para o repositório;
### P3 - 
O DateVo valida a data inicial e a data final e fica disponivel pra o serviço de dominio (FindAllCashFlowByDate) enviá-lo para o repositório;
### P4 - 
O serviço de dominio (FindAllCashFlowByDate) envia para o repositório os Value Objects TypeVO, DateVo, o número da página e a quantidade de itens a ser paginado  e obetido e os envia para o repositório;
### P5 - 
O reposiório retorna os fluxo de caixas;

### Fluxo de Exceção
### E1 -
O usuário envia para Api a data inicial e/ou data final inválida e/ou typo e/ou numero de pagina errada para obeter os fluxos de caixa que desejado
### E2 -
Api retorna uma mensagem de erro informando o ocorido.

