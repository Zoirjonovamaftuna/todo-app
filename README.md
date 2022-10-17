Todo App

# Starting application

Clone the repository:

`git clone https://github.com/Zoirjonovamaftuna/todo-app.git todo-app`

Move to the project folder

`cd todo-app`

Copy .env

`cp .env.example .env`

Start application

`docker-compose up -d`

Run migrations

`docker-compose exec app php artisan migrate`

Run seeds

`docker-compose exec app php artisan db:seed`

## Ready to use

### Login Route

Example of POST request to `http://localhost:8000/api/auth/login`

    {
        "email" : "john@gmail.com",
        "password" : "password"
    }

### Store Todo List Route

Example of POST request to `http://localhost:8000/api/todo-list`

    {
        "name" : "Books List To Buy",
        "todos" : [
            {
                "title" : "Атлант расправил плечи. Айн Рэнд",
            },
            {
                "title": "Третья Дверь. Алекс Банаян"
            }
        ]
    }
