# UAS Simple PHP App

Features:
- Routing via `.htaccess` and `index.php` front controller
- Responsive UI using Bootstrap (mobile-first)
- Login system with roles `admin` and `user`
- CRUD for products (admin only)
- Search/filter and pagination

Setup:
1. Place this folder in your Apache `htdocs` (example: `C:\xampp\htdocs\gatau`).
2. Update DB credentials in `config.php` if needed.
3. Create database `gatau_db` (or change `dbname` in `config.php`).
4. Run the setup script:

```bash
php scripts/setup.php
```

5. Start Apache, visit `http://localhost/gatau/`.

Default accounts:
- admin / password
- user / password
