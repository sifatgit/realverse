# Realverse – Advanced Real Estate Platform  

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)  
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)  
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)  
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)  
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)  
![jQuery](https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white)  
![AJAX](https://img.shields.io/badge/AJAX-005A9C?style=for-the-badge)  
![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)  

**Realverse** is a full-stack Laravel real estate platform featuring **multi-role authentication, real-time interactivity, and complete property management**.  
This project demonstrates my ability to build **complex, scalable, and highly interactive applications** for real-world use cases.  

🚀 **[Live Demo – Realverse Online](https://realverse.online)**  

---

## 🌟 Key Features  

### 🔑 Authentication & Security  
- **Multi-Guard Authentication** – Separate **user** and **admin** login using Laravel Breeze. Both can stay logged in simultaneously from the same browser.  
- **Token-Based Admin Access** – Admin login requires a secure token in the URL (e.g., `/admin/login?admin_token=your_token`).  

### 🏠 User-Facing Features  
- **Property Management** – Users can add, view, edit, and delete their listings.  
- **Browse & Rate Properties** – Visitors can explore listings, observe details, and leave property ratings (AJAX-powered).  
- **Advanced Search** –  
  - **Real-time AJAX search** by location, price, size, or amenities.  
  - **Dedicated search results page** for detailed browsing.  
- **Blog System** – Informative blog posts with AJAX-based commenting system.  
- **Real-Time Interactions** – AJAX used for property ratings, blog comments, and **instant form validations** across every form.  
- **Social Media Sharing** – Share properties or blogs directly to social platforms.  

### 🛠️ Admin Panel (CMS)  
A **complete content & property management system** with control over:  
- Apartment projects (floor & unit-wise)  
- Customers & agents  
- User-submitted units & rated properties  
- Image sliders & venues  
- Blogs, newsletters, & subscriptions  
- Customer messages & inquiries  
- Full site settings & configurations  

### 📱 Design & Performance  
- **Responsive & Scalable** – Optimized for desktop and mobile devices.  
- **Performance-Oriented** – AJAX for seamless interactivity, minimal reloads.  
- **Secure & Reliable** – Middleware-based token authentication and validated inputs.  

---

## 🛠️ Technologies Used  

- **Backend:** Laravel PHP, Middleware, Multi-Guard Authentication  
- **Frontend:** Bootstrap, jQuery, AJAX, JavaScript  
- **Database:** MySQL  
- **Version Control:** Git & GitHub  

---

## 🔮 Planned Features  

- Social login (Facebook & Google integration)  
- Automated property brochure generator (PDF export for listings)  

---

## 💼 What This Project Demonstrates  

- Building **multi-role authentication systems** with Laravel Breeze  
- Designing **secure admin workflows** (middleware + token authentication)  
- Implementing **AJAX-powered interactivity** (search, comments, ratings, validation)  
- Creating a **full CMS-style admin panel** for complete site management  
- Delivering a **scalable, production-ready Laravel application**  

---

## ⚙️ Installation & Setup Guide  

Follow these steps to run the project locally:  

### 1. Clone the repository  
```bash
git clone https://github.com/your-username/realverse.git
cd realverse
```
### 2. Install dependencies

```bash
composer install
npm install
```
### 3. Configure environment

```bash
cp .env.example .env
```

Update these fields in .env:

```php 
DB_DATABASE=your_database_name  
DB_USERNAME=your_username  
DB_PASSWORD=your_password  
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Run migrations & seed database

```bash 
php artisan migrate
```

### 6. Start the development server

```bash 
php artisan serve
```
Enter: [http://127.0.0.1:8000](http://127.0.0.1:8000/) to run the project 

### Notes

#### You can either run this command to populate the database

```bash 
php artisann db:seed
```

#### Or you can simply download: realverse.sql and import it your database.

#### For accessing admin panel check the AdminSeeder.php for login credentials
#### Also replace admin token in the .env with your prefered custom token code

```php 
ADMIN_ACCESS_TOKEN=Your_token_here
```
#### Access admin via http://127.0.0.1:8000/admin/login?admin_token=Your_token_here
