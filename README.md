# PracticalTestMyWebsite

A simple, mobile-friendly 4-page PHP website built with PHP 7/8, MySQL, NGINX, vanilla JavaScript, and Bootstrap (Quartz theme).

---

## Features

- Home, About Us, Privacy Policy, and Terms & Conditions pages  
- Privacy consent modal with cookie-based user consent tracking  
- Consent data stored securely in MySQL database  
- MVC-inspired architecture with separate folders for models, controllers, and views  
- CSRF protection implemented on form submissions  
- Responsive design using Bootstrap Quartz theme  

---

## Folder Structure

PracticalTestMyWebsite/
├── assets/ # Static assets like CSS (bootstrap.min.css)
├── controllers/ # JavaScript controllers (e.g. consentController.js)
├── models/ # PHP backend logic (e.g. consentModels.php, database interaction)
├── views/ # PHP views (home.php, about.php, privacy.php, terms.php, common header/footer)
├── route.php # Router logic
├── routes.php # Route declarations
├── index.php # Main entry point
├── config.php # Database config and other settings
├── db_schema.sql # Database schema for user consent tracking
└── README.md # Project documentation (this file)


---

## Setup Instructions

1. Install PHP 7 or 8, MySQL, and NGINX  
2. Configure NGINX to serve the project root and route PHP files via PHP-FPM  
3. Create MySQL database and import the `user_consent` table schema from `db_schema.sql`  
4. Configure database credentials in `config.php`  
5. Access the site via browser on your configured NGINX port  

---

## Database Schema

The database schema for the `user_consent` table is provided in [`db_schema.sql`](./db_schema.sql).  
Import it into your MySQL database to create the necessary table for consent tracking.

---

## Consent Modal Behavior

- Shows only on first visit or if user declines previously (cookie expires after 1 day if declined)  
- On acceptance, stores a GUID, timestamp, and version in a cookie (expires 1 year) and in the database  
- Blocks page scrolling while visible  

---

## NGINX Setup

Below is a sample NGINX server block configuration to serve this project:

```nginx
server {
    listen       8080;
    server_name  localhost;

    root /Users/yourusername/Desktop/StarMediaGroup/PracticalTestMyWebsite;
    index index.php index.html;

    client_body_timeout     5s;
    client_header_timeout   5s;
    keepalive_timeout       10s;
    send_timeout            15s;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        try_files $uri =400;
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include fastcgi_params;

        fastcgi_buffer_size 128k;
        fastcgi_buffers 4 256k;
        fastcgi_busy_buffers_size 256k;
    }
}

# Make sure to update the root path to your local project directory.

---

## NGINX Setup
