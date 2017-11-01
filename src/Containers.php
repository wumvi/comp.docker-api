<?php
declare(strict_types=1);

namespace DockerApi;

use DockerApi\Exception\Container as ContainerException;

class Containers extends Common
{
    public function getList()
    {
        $request = $this->makeGetRequest();
        $request->setUrl(self::URL . 'containers/json');

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 200) {
            throw new ContainerException($response->getData());
        }
    }
}
