1) setup and run 
2) php artisan migrate 
3) import postman collection file 

Category routes

Name : Get all the records
Method : Get
url : http://127.0.0.1:8000/api/category

Description : All the categories with pagination and order By latest one up


Name : Add new category with given payload
Method : Post
url : http://127.0.0.1:8000/api/category
Payload : {
    "name":"product three",
    "description":" unqired"
}

Description : create the new category with given the payload


Name : Get only those records which one are requested on url details are fetch and display.
Method : Get
url : http://127.0.0.1:8000/api/category/1


Description : Get only those records which one are requested on url details are fetch and display.


Name : Update the Category records with given payload
Method : PATCH
url : http://127.0.0.1:8000/api/category
Payload : {
    "name":"category 2",
    "description":"this for test"
}

Description : those column are change or send that value are updated


Name : Update the Category records with given payload
Method : Delete
url : http://127.0.0.1:8000/api/category/1


Description : delete the given records which is pass in url





Products routes

Name : Get all the records
Method : Get
url : http://127.0.0.1:8000/api/product

Description : All the records according to latest one with pagination on records


Name : Get particular records based pass record
Method : Get
url : http://127.0.0.1:8000/api/product/{id}

Description : particular the records according to the pass on url will fetch.


Name : Add particular records based pass record
Method : Post
url : http://127.0.0.1:8000/api/product
Payload : {
    "name":"product",
    "description":" unqired",
    "price": 100,
    "quantity":"10",
    "categories":[3]
}

Description : Create new products are add.

Name : update  particular records based pass record
Method : PATCH
url : http://127.0.0.1:8000/api/product/{id}
Payload : {
    "name":"product",
    "description":" unqired",
    "price": 100,
    "quantity":"10",
    "categories":[3]
}

Description : particular the records according to the pass only those column are update.

