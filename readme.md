# LARAVEL-PDO

## SETUP PROJECT LOCALLY:
(WINDOWS)

### 1. Download XAMPP
  - Install, run
  - Need to run both "Apache" and "MySQL"
  
### 2. Make Virtual Host
Go to "C:\xampp\apache\conf\extra\httpd-vhosts.conf" and add these bellow:
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName locahost
</VirtualHost>
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/racebets/public"
    ServerName racebets.dev
</VirtualHost>
```


### 3. Download Git Project
Download (this) project from GIT as zip and unpack it in 'xampp/htdoc', full link of the folder should be: "C:\xampp\htdocs"
Be sure to rename project to "racebets" and put in "htdocs" so you should have 
```
C:\xampp\htdocs\racebets
```


### 4. Change Your Hosts
Open any text editor in "RUN AS ADMINISTRATOR" mode and go to "C:\Windows\System32\drivers\etc" and open "hosts" file. If you don't run text editor in run as administrator you won't be able to see the "etc" folder or change (save) it.

NOTE: Some antiviruses won't allow you to change the "hosts" file, you need check/uncheck option in your antivirus so you would be able to change the file.
- When you open "hosts" file at the bottom add two new lines:
```
127.0.0.1 localhost
127.0.0.1 racebets.dev
```
- We will use "racebets.dev" link instead of "localhost"


### 5. Install composer
5.1 (EASY VERSION)- Install via Visual Studio Code, use "Integrated Terminal" from view drop down and just type "composer install --prefer-dist".

5.2 OR (HARD VERSION ) - You can install via some SHH program like Putty, but before that you need some kind of program to set your shh, like "FreeSSHd", but good luck setting that to work locally. Anyways, you need to put the same command "composer install --prefer-dist".
- Choose option one with Visual Studio Code


### 6. Open .env in the project root folder and setup your database connection


### 7. Create Database Table
7a -Run (go to) ```"http://racebets.dev/api/v1/customers/createTable"``` to create database table

7b - You can do via DHC, bellow is an example


### 8. TRY API
You can use any DHC client or what you like to try API, I use Chrome addon called "Restlet Client - Rest API Testing", 
link for addon: [DHC REST](https://chrome.google.com/webstore/detail/restlet-client-rest-api-t/aejoelaoggembcahagimdiliamlcdmfm?hl=en).
But you can use whatever you want




## API CALLS:

#### Create Table
```
Method: GET
http://racebets.dev/api/v1/customers/createTable
```

#### Add New Customer
```
Method: POST 
http://racebets.dev/api/v1/customer
```

#### Deposit Money
```
Method: PUT
http://racebets.dev/api/v1/customer/1/deposit
```

#### Withdraw Money
```
Method: PUT 
http://racebets.dev/api/v1/customer/1/withdraw
```

#### Edit Customer
```
Method: PUT 
http://racebets.dev/api/v1/customer/1
```

#### Get Customer
```
Method: GET
http://racebets.dev/api/v1/customer/1
```

#### Report with default (7) days 
```
GET
http://racebets.dev/api/v1/customers/report
```

#### Report with manual days
```
GET
http://racebets.dev/api/v1/customers/report/7
```



### $ ROUTE LIST
|  Method   |    URI                                  |    Name          |  Implemented |
| --------- | --------------------------------------- | ---------------- | ------------ |
| GET|HEAD  | api/user                                |                  |     Yes      |
| GET|HEAD  | api/v1/customer                         | customer.index   |     No       |
| POST      | api/v1/customer                         | customer.store   |     YES      |
| GET|HEAD  | api/v1/customer/create                  | customer.create  |     No       |
| GET|HEAD  | api/v1/customer/{customer}              | customer.show    |     YES      |
| PUT|PATCH | api/v1/customer/{customer}              | customer.update  |     YES      |
| DELETE    | api/v1/customer/{customer}              | customer.destroy |     No       |
| GET|HEAD  | api/v1/customer/{customer}/edit         | customer.edit    |     No       |
| PUT       | api/v1/customer/{id}/deposit            |                  |     YES      |
| PUT       | api/v1/customer/{id}/withdraw           |                  |     YES      |
| GET|HEAD  | api/v1/customers/createTable            |                  |     YES      |
| GET|HEAD  | api/v1/customers/report                 |                  |     YES      |
| GET|HEAD  | api/v1/customers/report/{timeFrameDays} |                  |     YES      |



## TODO
 - Make database dipendency injection
 - Make frontend
 - Use Aspect Oriented Programing  for SQL queries using PROXY DESIGN PATTERN


:alien: :alien: :alien: 
