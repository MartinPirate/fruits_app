# test fruit NInja

simple test using symfony 6 and vue 3, Typescript, Tailwindcss, MySQL, Docker, Github Actions, PHPUnit, Cypress, and more.


### missing and incomplete

> **List of incomplete tasks:**
>
> -Email sending notifcation to the user is incomplete.
>
> -units tests are not implemented yet.
>
> -docker images and github actions are not available.
>
>  -the project is not deployed yet.
>
> -integration tests are not implemented yet.
>
> -UI tests and authentication are not implemented yet.

### Running the CI locally

The CI can run on a local machine using the following instructions:

- Setup a Fedora/RHEL/CentOS-Stream VM (recently tested on Fedora 35 and CentOS-Stream 8)
    - clone the repo.
    - create a mysql database instance.
    - Run the bash following commands
      ```bash
      $ composer install
      
      $ cp .env.example .env # to create the .env file
      
      $ npm install
      
      $ npm run dev # to compile the assets
      
      $ bin/console doctrine:migrations:migrate  # to create the database tables
      
       $ php bin/console app:fetch-fruits # to fetch the fruits from the API
      
      $ symfony server:start

      ```

Open the application in a web browser:

- http://localhost:8000

samples
all fruits are imported from the API
![img.png](img.png)

Home page with the fruits
![img_1.png](img_1.png)
   
Add to Favorite alert
![img_2.png](img_2.png)

Remove from Favorite alert
![img_3.png](img_3.png)

Filter by Fruit Name

![img_4.png](img_4.png)

Filter by Fruit Family
![img_5.png](img_5.png)

fruit details page

![img_6.png](img_6.png)