
```bash
\App\Models\project::factory() 
```
- The command above in tinker will create a new project with the default values in the factory file.


- The command below in tinker will create a new project with the default values in the factory file and save it to the database.

```bash
\App\Models\project::factory()->create() 

# to create a given number of projects, you can use the command below
\App\Models\project::factory(5)->create()
```

- To check all the projects in the database, you can use the command below in tinker:
```bash
\App\Models\project::all()
```

- To drop all the migrations and refresh the database, you can use the command below:
```bash
php artisan migrate:refresh
```
- After running the command above, you can run the command below to seed the database with the default values in the factory file:
```bash
php artisan db:seed
```
