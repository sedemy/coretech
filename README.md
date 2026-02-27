# How to use ?

```
* git clone https://github.com/sedemy/coretech.git
```
```
* cd coretech
```

add user and database name to .env file

```
* composer install
```
```
* php artisan serve
```
```
* php artisan migrate:fresh --seed
```
seeder will add 4 users with the same password 123456

user1@example.com , user2@example.com , user3@example.com , user4@example.com

seeder will add 4 contracts related to the 4 users tenant_id

you should login first by using the login api to access other apis


You can check postman collection from [here](https://github.com/user-attachments/files/25612146/Coretech.postman_collection.json)

