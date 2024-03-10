# Inventory Management Software - Backend

This repository contains the backend implementation of an inventory management software system developed using Spring Boot and PostgreSQL.

## Features

- **CRUD Operations**: Implements Create, Read, Update, and Delete operations for managing inventory items.
- **Authentication and Authorization**: Provides secure access to the system with user authentication and role-based access control.
- **Persistence with PostgreSQL**: Utilizes PostgreSQL as the relational database management system for data storage.
- **RESTful API**: Offers a set of RESTful API endpoints for seamless communication with the frontend.

## Technologies Used

- **Spring Boot**: Framework for building Java applications, simplifying development with its convention over configuration approach.
- **PostgreSQL**: Open-source relational database management system known for its reliability and performance.
- **Spring Data JPA**: Simplifies the implementation of data access layer by providing easy-to-use APIs for working with databases.
- **Spring Security**: Provides comprehensive security features for Spring-based applications, including authentication and authorization.
- **Spring MVC**: Web framework that facilitates the development of web applications following the Model-View-Controller architecture.
- **RESTful API Design**: Utilizes REST principles to design clean and predictable API endpoints.

## Getting Started

To set up the project locally, follow these steps:

1. **Clone the Repository**:
git clone https://github.com/vinaylomate/InventoryManagement.git

3. **Set Up the Database**:

- Install PostgreSQL if not already installed.
- Create a new PostgreSQL database for the project named ("rar").
- Configure the database connection details in the `application.properties` file.

3. **Run the Application**:

- Navigate to the project directory.
- Run the following command:

  ```
  mvnw spring-boot:run
  ```

4. **Access the API**:

- The API endpoints are available at `http://localhost:8080/api/`.
- Here are some of the main API endpoints:

  - `GET /manage/get/productRegister/{companyId}/{productTypeId}/{productCategoryId}/{search:.+}/{pageNumber}/{pageSize}`: Retrieve all inventory items with pagination.
  - `POST /manage/add/productRegister/{companyId}/{uomId}/{productTypeId}/{productCategoryId}/{userId}`: Create a new inventory item and which user created this item.
  - `DELETE /manage/delete/productRegister/{productRegisterId}/{userId}`: Delete an inventory item by ID and which user deleted this item.
