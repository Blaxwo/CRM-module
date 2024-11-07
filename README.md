# Project Name
A Laravel-based application for managing user data and sending email notifications.

## Table of Contents
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Environment Setup](#environment-setup)
- [Running the Project Locally](#running-the-project-locally)
- [Using the Application](#using-the-application)
- [Troubleshooting](#troubleshooting)

## Prerequisites
- **PHP**: Version 8.x or later
- **Composer**: Dependency manager for PHP
- **Node.js** and **npm**: Required for frontend asset management
- **MySQL** or **PostgreSQL**: For database storage
- **Redis** (Optional): For handling queues if email notifications are queued

Make sure all tools above are installed and available in your system path.

## Installation

### 1. Clone the Repository
Clone the repository to your local machine:

```bash
git clone https://github.com/yourusername/your-repo-name.git
cd your-repo-name
```

## 2. Install PHP Dependencies
Use Composer to install the required PHP packages:

```bash
composer install
```
## 3. Install Node.js Dependencies
Run the following command to install frontend packages:

```bash
npm install
```

## Environment Setup

### 1. Copy .env File
Copy the example environment file:

```bash
cp .env.example .env
```

## 2. Configure Environment Variables

Open the `.env` file in a text editor and configure the following variables:

- `APP_NAME`: Your application name
- `APP_URL`: Local URL for accessing the app (e.g., `http://localhost:8000`)
- `DB_CONNECTION`: mysql
- `DB_HOST`: 127.0.0.1
- `DB_PORT`: 3306
- `DB_DATABASE`: Database name
- `DB_USERNAME`: Database username
- `DB_PASSWORD`: Database password
- `MAIL_MAILER`: ampt
- `MAIL_HOST`: smtp.mailtrap.io
- `MAIL_PORT`: SMTP port
- `MAIL_USERNAME`: SMTP username
- `MAIL_PASSWORD`: SMTP password
- `QUEUE_CONNECTION`: redis
- `OPENWEATHER_API_KEY`: Your API key for OpenWeather
- `OPENWEATHER_BASE_URL`: "https://api.openweathermap.org/data/2.5/forecast"
- `CACHE_DURATION`: 60
