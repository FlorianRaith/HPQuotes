# HPQuotes

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/9d7ff9d8742d4a84b9a4e24e6ac3b26b)](https://app.codacy.com/manual/FlorianRaith/HPQuotes?utm_source=github.com&utm_medium=referral&utm_content=FlorianRaith/HPQuotes&utm_campaign=Badge_Grade_Dashboard)

A little webapp where you have to guess the correct author of a quote from the harry potter books.  
  
## Stack

* Frontend: Vue.js  
* Backend: Laravel  

## Setup

All you need is a SQL database to get things running.

**Step1:**  
Make a copy of `.env.example` named `.env`.  
  
**Step2:**  
Generate an unique app key using `php artisan key:generate`.  
  
**Step3:**  
Enter your database credentials into `.env`.  
  
**Step4:**  
Run migrations using `php artisan migrate`.  
If you need test data you can use `php artisan db:seed` to generate some.  

**Step5:**  
Run the application with `php artisan serve`  