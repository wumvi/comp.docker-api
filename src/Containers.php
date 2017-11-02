<?php
declare(strict_types=1);

namespace DockerApi;

use DockerApi\Exception\Containers\Inspect as InspectException;
use DockerApi\Exception\Containers\ListException;
use DockerApi\Response\Containers\Inspect as InspectResponse;

class Containers extends Common
{
    public function list()
    {
        $request = $this->makeGetRequest();
        $request->setUrl(self::URL . 'containers/json');

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 200) {
            throw new ListException($response->getData());
        }
    }

    public function inspect(string $name): InspectResponse
    {
        if ($name === 'self') {
            $line = fgets(fopen('/proc/self/cgroup', 'r'));
            preg_match('#/docker/(\w{12})#', $line, $match);
            $name = $match[1];
        }

        $request = $this->makeGetRequest();
        $request->setUrl(self::URL . 'containers/' . $name . '/json');

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 200) {
            throw new InspectException($response->getData());
        }

        return new InspectResponse($response->getData());
    }
}
