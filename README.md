# Event System

**Pre Requirements**:  
Install [Xamp 7.4](https://www.apachefriends.org/download.html)  
Install [Composer](https://getcomposer.org/)  
Install [Node.js](https://nodejs.org/en/)

# Project Setup

- Clone the project and extract.
- go to event-system-main folder
- Follow the below steps for Backend and Frontend Setup.

## Backend Setup:

1.  Go to backend/
2.  Copy and Paste .env.example file and rename it to .env
3.  Add your database details in .env file
4.  Open cmd and run the below commands

```
composer install
```

```
php artisan migrate --seed
```

```
php artisan passport:install
```

```
php artisan key:generate
```

```
php artisan serve
```

Backend setup **DONE** !!  
Now Minimize this cmd and go back to main project folder for fontend setup.

## Frontend Setup:

1.  Go to Main Project Folder: /
2.  Open cmd and run the below commands

```
npm install
```

```
npm run serve
```

Frontend setup **DONE** !!  
open the url: http://localhost:8080 in your browser !

**Login Details**:  
Email: admin@email.com  
Password:123
