# URL Shortner

Created with Codeigniter and grocerycrud

## Setup

after downloading project run `composer update`, then run `php spark migrate` to run migrations.

You can define base url, database setting and other Codeigniter related settings in `.env` file.

---


Main URL is defined in `app/config/Constants.php`.

---
Login page route is at `/login`.  
Users (username, password) are defined in `/app/Controllers/BaseController.php`, inside `initController` method, `users` property.  

**password must be hashed by bcrypt**  
You can use https://bcrypt-generator.com/ to generate your custom password.


---

![Demo](https://raw.githubusercontent.com/msalehi-d/ci-url-shortener/master/demo1.png "Demo")
