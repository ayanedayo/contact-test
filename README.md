# FashionablyLate（お問い合わせフォーム）

## 環境構築

### Dockerビルド
1. https://github.com/ayanedayo/contact-test.git
2. docker-compose up -d --build
   - MySQLが起動しない場合は、各自のPC環境に合わせて docker-compose.yml を修正

### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.example をコピーして .env 作成
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

---

## 使用技術
- PHP 8.0  
- Laravel 8.0  
- MySQL 8.0  
- Docker / Docker Compose  

---
## ER図
![ER図](docs/ERD.png)

## URL
- 開発環境: http://localhost/  
- phpMyAdmin: http://localhost:8080/