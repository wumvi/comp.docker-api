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
#### Для текста
```
curl -X POST -H "Content-Type: application/json" --unix-socket /var/run/docker.sock http://localhost/containers/359b3a116ae3e/exec -d '{ "AttachStdin":false,"AttachStdout":true,"AttachStderr":true, "Tty":false, "Cmd":["/bin/bash", "-c", "ps ax"]'}
```

```
curl -X POST -H "Content-Type: application/json" --unix-socket /var/run/docker.sock http://localhost/exec/aac679c66a0890ea80a209d9dd3db556f0670da5770497fb8eb40526f5e0009f/start -d '{"Detach": false,"Tty": false}'
```

```
curl -X GET --unix-socket /var/run/docker.sock http://localhost/exec/aac679c66a0890ea80a209d9dd3db556f0670da5770497fb8eb40526f5e0009f/json 
```

