# InventoryManagement

> A Spring Boot-based Inventory Management system that demonstrates REST APIs, database integration, and basic inventory operations (CRUD for products, stock management, and order handling).

---

## Table of Contents

- [Project Overview](#project-overview)
- [Repository Structure](#repository-structure)
- [Prerequisites](#prerequisites)
- [Running Locally](#running-locally)
- [API Endpoints (examples)](#api-endpoints-examples)
- [Technologies](#technologies)

---

## Project Overview

This repository implements a simple Inventory Management application using Spring Boot. It provides REST endpoints to manage products, stock levels, and orders. The project is suitable as a starter template for small inventory systems or as a learning example for Spring Boot + JPA + REST.

## Repository Structure

```
InventoryManagement/
├─ src/
│  ├─ main/
│  │  ├─ java/...         # application source code (controllers, services, repositories, models)
│  │  └─ resources/       # application.yml/properties, data.sql, schema.sql
│  └─ test/               # unit and integration tests
├─ pom.xml
└─ docker-compose.yml (optional)
```

## Prerequisites

- Java 11+
- Maven (or use the `./mvnw` wrapper if present)
- PostgreSQL / MySQL / H2 (check `application.properties` for configured datasource)
- Docker & Docker Compose (optional, if you plan to run DB or the app in containers)

## Running Locally

1. Configure database connection in `src/main/resources/application.yml` or `application.properties`.
2. Build the project:
```bash
./mvnw clean package -DskipTests
```
3. Run the application:
```bash
./mvnw spring-boot:run
# or
java -jar target/<artifact>.jar
```

## API Endpoints (examples)

- `GET /api/products` — List products
- `GET /api/products/{id}` — Get product by id
- `POST /api/products` — Create product
- `PUT /api/products/{id}` — Update product
- `DELETE /api/products/{id}` — Delete product
- `POST /api/orders` — Create order / adjust stock

> Check controller classes in `src/main/java` for exact paths and request/response payloads.

## Technologies

- Java + Spring Boot
- Spring Data JPA (Hibernate)
- REST (Spring Web)
- Maven
- PostgreSQL / H2 (depends on configuration)
