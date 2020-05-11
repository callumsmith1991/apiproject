<h1>Api Project</h1>
<h2>This is a Rest Api for demonstration purposes using laravel as a backend with a basic vue app for the front end</h2>
<h3>Routes</h3>
<p>GET:</p>
<ul>
<li><strong>/api/</strong> will return a list of all books (if any)</li>
<li><strong>/api/categories/</strong> will return a list of all categories (if any)</li>
<li><strong>/api/categories/{filter}</strong> will return a list of all books in provided filtered category (if any)</li>
<li><strong>/api/categories/{filter}/author/{filter}</strong> will return a list of all books in provided filtered category by provided filtered author</li>
<li><strong>/api/author/{filter}</strong> will return a list of all books by provided filtered author</li>
</ul>
<p>POST:</p>
<ul>
<li><strong>/api/create/</strong> Create a new book using this endpoint. ISBN, title, author and price names are required, category optional</li>
</ul>
<h3>Usage</h3>
<p>Simply set up .env file, install composer in project and run php artisan migrate --seed to get app up and running</p>
