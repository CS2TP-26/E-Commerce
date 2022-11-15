If you get a 404 error, it's probally due to the connection.php pointer, which is located in the root directory of the project. 
Just make sure that its ../connection.php instead of ../../connection.php


This is a git push and pull test

When editing locally, you might see some errors with php modules, This is because the host machine had the modules, and your local machines doesnt.
