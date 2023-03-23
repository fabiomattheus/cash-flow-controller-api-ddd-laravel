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
Usuário do sietema.
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

## Diagrama de Caso de Uso Deletar Fluxo de Caixa
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/update_cah_flow_use_case_diagram.drawio.png)

## Descrição do Caso de Uso Deletar Fluxo de Caixa

## Diagrama de Caso de Uso Localizar Fluxo de Caixa por Id
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/find_cash_flow_by_id.drawio.png)

## Descrição do Caso de Uso Localizar Fluxo de Caixa por Id

## Diagrama de Caso de Uso Localizar Todos Fluxos de Caixa por Data
![alt text](https://github.com/fabiomattheus/cash-flow-controller-api-ddd-laravel/blob/main/app/core/Diagrams/find_all_cash_flow_by_date.drawio.png)
## Descrição do Caso de Uso Localizar Fluxo Todoss de Caixa por data
