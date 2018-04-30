# Property API demo

This demo is for the No Agent API code test.

This API returns a JSON response containing a query result or a status message.

Current endpoint is: https://sparrow.flapflap.net/api/properties

## Installation: 

git clone gitlab.flapflap.net/properties-api
composer install
[edit .env file with DB login]
php artisan migrate

Requirements: SQL databse. I used postgres.

- Endpoint: /api/properties

## Functions:

- /list: Shows all entries

- /get?id= : Get specific entry by ID

- /delete?id= : Delete specific entry by ID

- /search?String= : Search by string

- /add?Address1=&Address2=&City=&Postcode= : Add a property

## Todo:

- Auth

- Tests

- Backend geocoding queue worker


