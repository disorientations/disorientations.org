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
```

Then point your browser here to do [initial
setup](https://omeka.org/s/docs/user-manual/install/#initial-setup):
http://localhost:8080
