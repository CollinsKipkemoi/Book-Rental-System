
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

<!-- !STEPS FOR CREATING A MODELS READY FOR SEEDING -->

<!-- *(i) create a model using the command below: -->
```bash
php artisan make:model project  #replace project with the name of the model
```
<!-- *(ii) define the schema in the migration file created in the database/migrations folder -->

<!-- *(iii) run the command below to create the table in the database: -->
```bash
php artisan migrate
```
This will create the table in the database.

<!-- *(iv) define the fillable fields in the model file created in the app/Models folder -->


<!-- *(v) Create a seeder file using the command below: -->
```bash
php artisan make:seeder projectSeeder  #replace projectSeeder with the name of the seeder
```
Then update the seeder file created in the database/seeders folder with the default values you want to seed the database with.
for example:
```php
public function run()
{
    // truncate the table before seeding
    \App\Models\project::truncate();
    \App\Models\project::factory(5)->create();
}
```

<!-- *(vi) create a factory file using the command below: -->
```bash
php artisan make:factory projectFactory  #replace projectFactory with the name of the factory
```
Then update the factory file created in the database/factories folder with the default values you want to seed the database with.

<!-- *(vii) Finally run the command below to seed the database with the default values in the factory file: -->
```bash
php artisan db:seed
```
