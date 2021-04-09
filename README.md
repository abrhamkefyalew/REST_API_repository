# REST_API_repository
This project is done using REST API concept. (each interface is exchanging data using only JSON data format. this concept enables to interconnect different applications or websites despite the technology that is used to create them). This web app does some basic CRUD operations using API calls.


All information about the build and hosting enviroment.

- Operating System: - Windows 10 pro 64 bit
- Web server: - WAMP64
- project location: - C:\wamp64\www    (pest RestApi folder in this directory)
- So url will be = http://localhost/RestApi
- PHP Version: - 7.2.4
- MYSQL Version: - 5.7.21
- Apache Version: - 2.4.33


Tolls:
- use Postman or
- Web Browser (chrome or microsoft edge)
- wamp64
- Text editor

Code Documentation

RestApi/api/api.php
- It is the API interface for the REST HTTP API project.
- request for the http://localhost/RestApi/api/api.php and use parameter=value on the url.
- in my website parameter is 'perpose' 
- for example http://localhost/RestApi/api/api.php?perpose=count_all_users
- list of operations done the API


perpose=count_all_users (to count the number of all users)
- http://localhost/RestApi/api/api.php?perpose=count_all_users

perpose=last_name_count_all (to count the number of all users)
- - http://localhost/RestApi/api/api.php?perpose=count_all_users


