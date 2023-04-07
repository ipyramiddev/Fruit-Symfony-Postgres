# Favorite Fruit

## Build Setup

```bash
# install dependencies
$ composer install

# serve run at localhost:8000
$ symfony server:start

# Endpoints
$ GET: http://localhost:8000/fruit
Fetch all fruits from PostgreSQL database

$ GET: http://localhost:8000/fruit/init
Fetch fruits from "https://fruityvice.com/api/fruit/all"
Then store the fetched data into fruit table in fruit database
