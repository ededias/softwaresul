# Softwaresul

## Configurações do projeto

Rode o comando para instalar as dependecias
```sh
npm install
composer install
```

Para geração das migrations rode o comando

```sh
php artisan migrate
```

Para iniciar o projeto basta rodar o comando

```sh
composer dev
```

Para gerar livros aleatórios utilize do comando

```sh
php artisan db:seed --class=BookSeeder 
```

---

Optei por utilizar o componente padrão de segurança do Laravel (para criação de usuários, login, logout e edição) devido à restrição de tempo para a entrega do teste técnico. O restante dos recursos foram desenvolvidos por mim, utilizando Vue.js com Inertia. Escolhi o Vue.js em vez do Blade, pois é uma das ferramentas mencionadas na vaga, e optei pelo modelo monolítico em vez de desenvolver uma API separada e um front-end à parte, para ter a oportunidade de aprender a utilizar a ferramenta Inertia.