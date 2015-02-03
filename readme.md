
This application's framework was set up using composer of Rails. The database is SQLite and the data is saved in app/database/seeds. There is a cats table, and a breeds table. A breed has many cats. And there is a users table that saves username and password. The Eloquent ORM of laravel binds each table in the database with its correponding model, for example, the cats table with the model Cat. 

This app is based on the source code of the book "Getting Started with Laravel 4" by Raphael Saunier. I added the search and filer functions of laravel to make the app more user-friendly


