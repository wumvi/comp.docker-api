## Dev
### Docker
```bash
run --rm -d -v /var/run/docker.sock:/var/run/docker.sock -p 40:22 wumvi/www.dev
```

```php
include './vendor/autoload.php';

$exec = new \DockerApi\Exec();

$execArguments = new \DockerApi\Arguments\Exec\Prepare('img', 'ping ya.ru -c 1');
$id = $exec->prepare($execArguments);
$exec->start($id);
$response = $exec->inspect($id);
```


