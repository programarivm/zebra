# Zebra

Design methodology that consists in seeding a development database with sample fake data while designing it at the same time. Also this application behaves as a host in order to develop and test Symfony 5 bundles.

---

### Set up the Environment

    bash/dev/start.sh

### Update the Database Schema

    docker exec -itu 1000:1000 zebra_php_fpm php bin/console doctrine:migrations:diff
    docker exec -itu 1000:1000 zebra_php_fpm php bin/console doctrine:migrations:migrate

### Load the Fixtures

    docker exec -itu 1000:1000 zebra_php_fpm php bin/console doctrine:fixtures:load --group=zebra

### Run the Tests

    docker exec -itu 1000:1000 zebra_php_fpm php bin/phpunit

### Contributions

Would you help make this app better?

- Feel free to send a pull request
- Drop an email at info@programarivm.com with the subject "Zebra"
- Leave me a comment on [Twitter](https://twitter.com/programarivm)

Thank you.
