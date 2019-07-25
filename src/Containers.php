<?php
declare(strict_types=1);

namespace DockerApi;

use DockerApi\Arguments\Containers\CreateOptions;
use DockerApi\Exception\Containers\Create;
use DockerApi\Exception\Containers\Inspect as InspectException;
use DockerApi\Exception\Containers\Start as StartException;
use DockerApi\Exception\Containers\Wait as WaitException;
use DockerApi\Exception\Containers\Remove as RemoveException;
use DockerApi\Exception\Containers\ListException;
use DockerApi\Exception\Containers\Logs as LogsException;
use DockerApi\Arguments\Containers\Logs as LogsArguments;
use DockerApi\Response\Containers\Inspect as InspectResponse;
use LightweightCurl\CurlException;

class Containers extends Common
{
    private const CONTAINER_LENGHT = 12;

    /**
     * @throws ListException
     * @throws CurlException
     */
    public function list()
    {
        $request = $this->makeGetRequest();
        $request->setUrl(self::URL . 'containers/json');

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 200) {
            throw new ListException($response->getData());
        }
    }

    /**
     * @param string $name
     *
     * @return InspectResponse
     *
     * @throws CurlException
     * @throws InspectException
     */
    public function inspect(string $name): InspectResponse
    {
        $name = self::convertName($name);

        $request = $this->makeGetRequest();
        $request->setUrl(self::URL . 'containers/' . $name . '/json');

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 200) {
            throw new InspectException($response->getData());
        }

        return new InspectResponse($response->getData());
    }

    /**
     * @param CreateOptions $option
     *
     * @return string
     *
     * @throws Create
     * @throws \LightweightCurl\CurlException
     */
    public function create(CreateOptions $option): string
    {
        $request = $this->makePostRequest();
        $request->setUrl(self::URL . 'containers/create');

        $data = [
            'AttachStdin' => $option->isStdIn(),
            'AttachStdout' => $option->isStdOut(),
            'AttachStderr' => $option->isStdOut(),
            'Tty' => $option->isTty(),
        ];

        if ($option->getHostname()) {
            $data['Hostname'] = $option->getHostname();
        }

        if ($option->getCmd()) {
            $data['Cmd'] = $option->getCmd();
        } else {
            throw new Create('Cmd not found');
        }

        if ($option->getImage()) {
            $data['Image'] = $option->getImage();
        } else {
            throw new Create('Image not found');
        }

        $hostConfig = $option->getHostConfig();
        if ($hostConfig) {
            $conf = [];
            if ($hostConfig->getBinds()) {
                $conf['Binds'] = $hostConfig->getBinds();
            }

            $conf['AutoRemove'] = $hostConfig->isAutoRemove();
            $data['HostConfig'] = $conf;
        }

        $data = json_encode($data);

        $request->setData($data);

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 201) {
            throw new Create($response->getData(), $response->getHttpCode());
        }

        return json_decode($response->getData())->Id;
    }

    public static function convertName(string $name): string
    {
        if ($name === 'self') {
            $line = fgets(fopen('/proc/self/cgroup', 'r'));
            preg_match('#/docker/(\w{' . self::CONTAINER_LENGHT . '})#', $line, $match);
            return $match[1];
        }

        return $name;
    }

    /**
     * @param LogsArguments $argument
     *
     * @return string
     *
     * @throws CurlException
     * @throws LogsException
     */
    public function logs(LogsArguments $argument): string
    {
        $name = self::convertName($argument->getName());
        $params = [];

        if ($argument->isStdout()) {
            $params['stdout'] = $argument->isStdout();
            $params['stderr'] = $argument->isStderr();
            $params['since'] = $argument->getSince();
            $params['until'] = $argument->getUntil();
            $params['tail'] = $argument->getTail();
        }

        $query = $params ? '?' . http_build_query($params) : '';

        $request = $this->makeGetRequest();
        $request->setUrl(self::URL . sprintf('containers/%s/logs%s', $name, $query));

        $response = $this->curl->call($request);
        if ($response->getHttpCode() !== 200) {
            throw new LogsException($response->getData(), $response->getHttpCode());
        }

        return $response->getData();
    }

    /**
     * @param string $name
     *
     * @throws CurlException
     * @throws StartException
     */
    public function start(string $name) : void
    {
        $request = $this->makePostRequest();
        $request->setUrl(self::URL . 'containers/' . $name . '/start');

        $response = $this->curl->call($request);

        if ($response->getHttpCode() !== 204) {
            throw new StartException($response->getData());
        }
    }

    /**
     * @param string $name
     *
     * @throws CurlException
     * @throws StartException
     */
    public function wait(string $name) : void
    {
        $request = $this->makePostRequest();
        $request->setUrl(self::URL . 'containers/' . $name . '/wait');

        $response = $this->curl->call($request);

        if ($response->getHttpCode() !== 200) {
            throw new WaitException($response->getData());
        }
    }

    /**
     * @param string $name
     *
     * @throws CurlException
     * @throws StartException
     */
    public function remove(string $name) : void
    {
        $request = $this->makeDeleteRequest();
        $request->setUrl(self::URL . 'containers/' . $name);

        $response = $this->curl->call($request);

        if ($response->getHttpCode() !== 204) {
            throw new RemoveException($response->getData());
        }
    }
}
