# laravel-12-course

## Требования
* Docker Desktop(с настроенным WSL 2)
* Git
* Postman (для тестирования API)

---

## Инструкция по запуску

### 1. Клонирование репозитория
```bash
git clone <ССЫЛКА_НА_ВАШ_РЕПОЗИТОРИЙ>
cd workdirectory_php_laravel
```
### 2. Переменный окружения
````bash
cd deploy
cp .env.example .env

cd backend 
.env.example .env
````

### 3. Cид-данные
````bash
docker compose exec app php artisan db:seed
````

### 4. Запуск производится через Docker
````bash
docker compose up -d --build
````
