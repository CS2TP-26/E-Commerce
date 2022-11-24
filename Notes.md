If you get a 404 error, it's probally due to the connection.php pointer, which is located in the root directory of the project. 
Just make sure that its ../connection.php instead of ../../connection.php


This is a git push and pull test

When editing locally, you might see some errors with php modules, This is because the host machine had the modules, and your local machines doesnt.


Things need to be done:

An admin must be able to see a list of customers, a list of currently placed orders, a list of products that are
stocked

Customers must be able to access their basket at any time

Customers must be able to place an order, which submits their basket and registers it as an order in the database,
along with the total price (it is NOT necessary to include any method of payment, either by taking details or
through online payment systems)


Customers must be able to view their past orders, and see their status

Make sure that when someone goes to the basket it redirects them to the login page to make sure that they are logged in before they actually buy anything.

/login.php?redirect=checkout.php <- Something like this


