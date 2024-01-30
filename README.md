# gibjohn-tutoring
Learning platform prototype for digital T-Level.

Showcases basic functionality (although login and registration features are fully functional) with a trial quiz, teacher dashboard and some fancy design choices from college me.

Features special codes needed to make teacher accounts as specified in the project brief (cannot gain access as it is locked behind my college's system) as well as allowing to make student accounts if no code is provided.

## How to set up
### Database
Run `Database.sql` file to set up database (default DB name is "gibjohn").
Edit `server.php` and change preset info on line 10 your database credentials.

### Admin accounts
Valid codes for admin account: AABBCC1, AABBCC2, AABBCC3 (can edit in `server.php` line 19).
Register account in `register.php` and you should be in the teacher dashboard.
