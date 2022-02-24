# URL Shortner

Created with Codeigniter and grocerycrud

## Setup

You can define base url, database setting and other Codeigniter related settings in `.env` file.

---

Main URL is defined in `app/config/Constants.php`.

---

Users (username, password) are defined in `/app/Controllers/BaseController.php`, inside `initController` method, `users` property. 
 
**password must be hashed by bcrypt**

---
