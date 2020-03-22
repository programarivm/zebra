# Zebra

Data-driven database design methodology. Also this application behaves as a host in order to develop and test Symfony 5 bundles.

---

### Set up the Environment

    bash/dev/start.sh

### Update the Database Schema

    docker exec -itu 1000:1000 zebra_php_fpm php bin/console doctrine:migrations:diff
    docker exec -itu 1000:1000 zebra_php_fpm php bin/console doctrine:migrations:migrate

Alternatively:

    docker exec -itu 1000:1000 zebra_php_fpm php bin/console doctrine:schema:update --force

### Load the Fixtures

    docker exec -itu 1000:1000 zebra_php_fpm php bin/console doctrine:fixtures:load --group=zebra --group=easy-acl

### Run the Tests

    docker exec -it zebra_php_fpm php bin/phpunit

### Contributions

Would you help make this app better?

- Feel free to send a pull request
- Drop an email at info@programarivm.com with the subject "Zebra"
- Leave me a comment on [Twitter](https://twitter.com/programarivm)

Thank you.
