<?php
declare(strict_types=1);

namespace DockerApi;

use DockerApi\Exception\Exec\Prepare as PrepareException;
use DockerApi\Exception\Exec\Start as StartException;
use DockerApi\Arguments\Exec\Prepare as PrepareArguments;
use DockerApi\Response\Exec\Inspect as InspectResponse;

class Exec extends Common
{
    public function prepare(PrepareArguments $arguments): string
    {
        $request = $this->makePostRequest();
        $request->setUrl(self::URL . 'containers/' . $arguments->getContainer() . '/exec');

        $cmd = preg_replace('/\s+/', ' ', $arguments->getCmd());
        $cmd = explode(' ', $cmd);

        $data = [
            'Cmd' => $cmd,
            'AttachStdin' => $arguments->isStdIn(),
            'AttachStdout' => $arguments->isStdOut(),
            'AttachStderr' => $arguments->isStdOut(),
        ];

        $data = json_encode($data);
        $request->setData($data);

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 201) {
            throw new PrepareException($response->getData(), $response->getHttpCode());
        }

        return json_decode($response->getData())->Id;
    }

    public function start(string $id, bool $detach = false)
    {
        $request = $this->makePostRequest();
        $request->setUrl(self::URL . 'exec/' . $id . '/start');
        $request->setData(json_encode([
            'Detach' => $detach,
        ]));

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 200) {
            throw new StartException($response->getData(), $response->getHttpCode());
        }

        return $response->getData();
    }

    public function inspect(string $id): InspectResponse
    {
        $request = $this->makeGetRequest();
        $request->setUrl(self::URL . 'exec/' . $id . '/json');

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 200) {
            throw new StartException($response->getData(), $response->getHttpCode());
        }

        return new InspectResponse($response->getData());
    }
}
