# Backend PHP — API Times de Futebol

API REST implementada em **PHP puro** com Apache e PostgreSQL.
Expõe os mesmos endpoints que o `backend-nodejs` — o frontend não precisa saber qual backend está rodando.

## Como rodar

```bash
cp .env.example .env
docker compose up --build
```

Acesse `http://localhost:8080/docs` para a documentação interativa (Swagger UI).

## Endpoints

| Método   | Rota          | Descrição                |
|----------|---------------|--------------------------|
| `GET`    | `/times`      | Lista todos os times     |
| `GET`    | `/times/{id}` | Busca um time por ID     |
| `POST`   | `/times`      | Cria um novo time        |
| `PUT`    | `/times/{id}` | Atualiza um time         |
| `DELETE` | `/times/{id}` | Remove um time           |
| `GET`    | `/docs`       | Documentação Swagger UI  |

## Formato do objeto Time

```json
{
  "id": 1,
  "nome": "Grêmio",
  "fundacao": "1903",
  "estadio": "Arena do Grêmio",
  "cor_principal": "Azul"
}
```

## Estrutura

```
backend-php/
├── index.php               # Roteador (front-controller)
├── .htaccess               # Reescrita de URL para index.php
├── Database.php            # Conexão com o banco via PDO
├── Env.php                 # Carrega variáveis do .env
├── model/
│   └── TimeFutebol.php     # Entidade (Model)
├── dao/
│   └── TimeDao.php         # Acesso ao banco (DAO)
├── controller/
│   └── TimeController.php  # Lógica, retorna arrays para JSON
├── docs/
│   └── swagger.html        # Documentação Swagger UI
├── Dockerfile
├── compose.yaml
├── creates.sql             # DDL das tabelas
└── .env.example
```
