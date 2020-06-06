# Omeka S

Omeka S is a web publication system for universities, galleries, libraries,
archives, and museums. It consists of a local network of independently curated
exhibits sharing a collaboratively built pool of items, media, and their metadata.

See the [user manual](https://omeka.org/s/docs/user-manual) or [GitHub
repository](https://github.com/omeka/omeka-s) for more information.

## Running Locally

Use [Docker](https://www.docker.com/).

```sh
docker-compose up -d

# Create the MySQL database
docker-compose exec mysql mysql -e 'create database omekas'

# Create the database configuration
cp config/database.ini.dist config/database.ini

# Install dependencies via Composer
docker-compose exec php composer install
```

Then point your browser here to do [initial
setup](https://omeka.org/s/docs/user-manual/install/#initial-setup):
http://localhost:8080

## Importing Database

The following command will dump the production database to a local file.
Replace `SSH_USER`, `SSH_HOST`, `MYSQL_USER`, and `MYSQL_DATABASE` with
appropriate values.

```sh
ssh SSH_USER@SSH_HOST 'mysqldump -C -u MYSQL_USER -p MYSQL_DATABASE' > dump.sql
```

Upon running this command, you'll see a password prompt that looks like this:

```
Password: 
```

This prompt is for the SSH password. Once you enter it, you'll see another
password prompt that looks like this:

```
Enter password:
```

This prompt is for the MySQL password. After entering it, it may take a few
moments before the command terminates. At that point, the file `dump.sql`
should contain the database dump.

Now, to import this dump into your local instance of MySQL in Docker, run the
following command.

```sh
docker-compose exec mysql mysql -e 'source dump.sql' omekas
```
