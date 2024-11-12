# **TypeThu-API (typeScore)**

TypeThu-API is a backend API built with Symfony for a typing speed test application. This API supports managing typing tests, recording user scores, and retrieving test data, offering insights into typing accuracy and speed.

## **Table of Contents**
- [Project Setup](#project-setup)
- [Docker Setup](#docker-setup)
- [Environment Variables](#environment-variables)
- [Running the Project](#running-the-project)
- [API Endpoints](#api-endpoints)
- [Additional Notes](#additional-notes)

---

## **Project Setup**

### **Prerequisites**
- Docker and Docker Compose installed
- A code editor (e.g., VSCode) or terminal

### **Folder Structure**
Your project directory should look like this:

---

## **Environment Variables**

Create a `.env` file in the `typeScoreApi` directory with the following content:

## MySQL Database URL
`DATABASE_URL="mysql://root`
`@typeScore_db:3306/typeScore"`

## API settings
`APP_ENV=dev`
`APP_DEBUG=1`


These settings configure your database connection and Symfony environment. You can adjust them as needed.

---

## **Docker Setup**

This project uses Docker Compose to set up and run the following services:

- **Nginx**: Web server for serving the API.
- **Symfony API (typeScoreApi)**: The backend API application.
- **MySQL Database**: Data storage for user scores and test data.

### **Docker Compose Commands**

To start the project, open a terminal in the `backend` directory and run:

```bash```
docker-compose up --build


## **Running the Project
Clone the Repository
bash
Copy code
```git clone https://github.com/username/TypeThu-API.git```

```cd TypeThu-API/backend```

Set Up Environment Variables

Add your .env file to typeScoreApi as shown above.

Start the Project
Run `docker-compose up --build` from the backend directory.


Access the API
---
API Base URL: `http://localhost:8000`
Testing the Connection
Once the containers are up, you can test if the API is running by accessing   `http://localhost:8000/api` (or any route defined in your Symfony routes).

API Endpoints
---
Some sample endpoints in this API (you can add more details if needed):

GET /api/typing-tests: Retrieve available typing tests.
POST /api/test-results: Submit a typing test result.
GET /api/test-results/{id}: Retrieve specific test result data.
(You can expand this section with more endpoints as you develop the API.)

Additional Notes
Database Migrations
To set up or update database tables, run Symfony migrations after the container is up:

bash
Copy code
docker-compose exec api php bin/console doctrine:migrations:migrate
Debugging
Use APP_DEBUG=1 in the .env file for development mode. Make sure to set APP_DEBUG=0 for production.

Logs
Check Docker logs for debugging:

bash
Copy code
docker-compose logs -f
