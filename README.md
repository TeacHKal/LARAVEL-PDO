# LARAVEL-PDO







$ ROUTE LIST

+--------+-----------+-----------------------------------------+------------------+--------------+
| Domain | Method    | URI                                     | Name             |  Implemented |
+--------+-----------+-----------------------------------------+------------------+--------------+
|        | GET|HEAD  | api/user                                |                  |     Yes      |
|        | GET|HEAD  | api/v1/customer                         | customer.index   |     No       |
|        | POST      | api/v1/customer                         | customer.store   |     YES      |
|        | GET|HEAD  | api/v1/customer/create                  | customer.create  |     No       |
|        | GET|HEAD  | api/v1/customer/{customer}              | customer.show    |     YES      |
|        | PUT|PATCH | api/v1/customer/{customer}              | customer.update  |     YES      |
|        | DELETE    | api/v1/customer/{customer}              | customer.destroy |     No       |
|        | GET|HEAD  | api/v1/customer/{customer}/edit         | customer.edit    |     No       |
|        | PUT       | api/v1/customer/{id}/deposit            |                  |     YES      |
|        | PUT       | api/v1/customer/{id}/withdraw           |                  |     YES      |
|        | GET|HEAD  | api/v1/customers/createTable            |                  |     YES      |
|        | GET|HEAD  | api/v1/customers/report                 |                  |     YES      |
|        | GET|HEAD  | api/v1/customers/report/{timeFrameDays} |                  |     YES      |
+--------+-----------+-----------------------------------------+------------------+--------------+
