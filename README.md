# Supplements-Store

# Steps

1. Pull repo to whatever directory you want/
2. do `mklink /D C:\xampp\htdocs\suplement-store C:\Users\you\Projects\Suplement-Store`

# Repo Layout

<pre style="white-space: pre; overflow-x: auto;">
supplements-store/
│
├── public/             # Public-facing files (served by Apache)
│   ├── index.php       # Entry point (router or homepage)
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   └── uploads/        # User-uploaded images (product pics, etc.)
│
├── src/                # Source code (backend logic)
│   ├── controllers/    # Handle requests (e.g. ProductController.php)
│   ├── models/         # Database models (Product.php, User.php)
│   ├── views/          # Reusable HTML/PHP templates
│   ├── database/       # Database connection, migrations, seed data
│   ├── helpers/        # Utility functions
│   └── config.php      # Database credentials, constants, etc.
├── .gitignore          # Ignore cache files, uploads, etc.
├── composer.json       # For managing PHP packages (optional but pro)
└── README.md           # Project info, setup instructions
</pre>
