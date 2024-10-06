
# News Aggregator - Laravel Project

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)


## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
    - [Configuration](#configuration)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Contributing](#contributing)
- [Acknowledgements](#acknowledgements)
- [Additions](#additions)
- [Contact](#contact)


## Introduction

This is a news aggregator built with Laravel that fetches articles from multiple news sources (like NewsAPI,
The Guardian, and The New York Times) and provides an API for retrieving articles based on filters such as search queries,
categories, and sources. The system stores articles in a local database and updates them regularly to ensure fresh content.


## Features

- Fetch articles from multiple sources (NewsAPI, The Guardian, The New York Times).
- Store articles in a local database.
- Retrieve articles via API with filtering options for date, category, and source.
- Scheduled tasks for regular data updates.


## Getting Started


### Prerequisites

Make sure you have the following software installed :
- PHP >= 8.0
- Composer
- MySQL
- Laravel 9.x


### Installation

Follow these steps to set up the project locally :

```bash
# Clone the repository
git clone https://github.com/YOUSSEIFJOO/news-aggregator.git news-aggregator

# Navigate into the project directory
cd news-aggregator

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Configuration

1- Copy the .env.example file to .env and set your environment variables :

```bash
cp .env.example .env
```

2- Set your database credentials in the .env file :

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news-aggregator
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

3- Generate the application key :

```bash
php artisan key:generate
```

4- Migrate the database :

```bash
php artisan migrate
```


### Usage

To start the local server and test the application, use :

```bash
php artisan serve
```

You can now access the application at http://localhost:8000.


### API Endpoints

```bash
GET ( /api/articles ) Retrieve all articles
```


### Contributing

If you'd like to contribute :

```bash
1- Fork the repository.
2- Create your feature branch (git checkout -b feature/your-feature).
3- Commit your changes (git commit -m 'Add your feature').
4- Push to the branch (git push origin feature/your-feature).
5- Open a pull request.
```


### Acknowledgements

- NewsAPI for providing news articles.
- Laravel framework for its simplicity and power.


### Additions

1. **Swagger**: Suggested for API documentation and testing, including the `l5-swagger` package and usage instructions.
2. **Laravel Octane**: Explained as a way to improve performance with steps to install and run Octane.
3. **Redis**: Highlighted for caching, with instructions to configure it in the `.env` file.

- This will give the project a professional touch while indicating performance-focused suggestions for further improvements.

- **Note** : When you try to use ( **Laravel Octane** && **Redis** ) Ensure you installed the requirements on your machine at the first.


### Contact

Developed by <a href="https://www.linkedin.com/in/yousseif" target="_blank">Yousseif Nady</a>. Reach out at [yousseif@example.com]() for any questions or inquiries.
