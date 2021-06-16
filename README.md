<h1>How to clone and use this Project</h1>
<p>Notes: Everything inside " ", copy and paste into your terminal</p>
<ol>
    <li>
    "git clone https://github.com/Fajar3108/Minigram.git project_name"
    </li>
    <li>"cd project_name"</li>
    <li>"composer install"</li>
    <li>"npm install"</li>
    <li>"cp .env.example .env" or "copy .env.example .env"</li>
    <li>"php artisan key:generate"</li>
    <li>Create a new database called 'minigram' or whatever you want</li>
    <li>Change databse name in .env file</li>
    <li>"php artisan migrate --seed"</li>
    <li>Setting integration in .env file for email verification (I'm using mailtrap.io for development testing)</li>
    <li>"php artisan serve"</li>
</ol>
