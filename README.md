# Supplements-Store

# Steps


## For linux
1. clone repo
2. install docker
3. go in folder
4. run docker compose up -d
5. if error: do docker compose down -v and step 3 two. Repeat until the end.

## For windows
1. same, but install docker desktop

# Repo Layout

<pre style="white-space: pre; overflow-x: auto;">
supplements-store/
├── Dockerfile
├── LICENSE
├── README.md
├── about_route.php
├── actions
│   ├── add_product.php
│   ├── cart_action.php
│   ├── delete_user.php
│   ├── login_action.php
│   ├── logout.php
│   └── register.php
├── admin_route.php
├── api
│   ├── get_products.php
│   └── get_users.php
├── cart_route.php
├── config.php
├── css
│   └── style.css
├── db-init
│   └── supplement_store.sql
├── docker-compose.yml
├── img
│   └── user.png
├── includes
│   ├── footer.php
│   └── navbar.php
├── index.php
├── layout.php
├── login_route.php
├── pages
│   ├── about.php
│   ├── admin_panel.php
│   ├── cart.php
│   ├── home.php
│   ├── login.php
│   └── sign_up.php
├── signup_route.php
├── todo.md
└── uploads
</pre>
