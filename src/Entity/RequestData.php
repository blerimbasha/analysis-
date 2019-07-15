<?php


namespace App\Entity;


class RequestData
{
    public $host ;
    public $datetime;
    public $request;
    public $response_code;
    public $documnt_size;

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     * @return RequestData
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     * @return RequestData
     */
    public function setDatetime($datetime)
    {
        $datetime = preg_replace("/\[|\]/", "", $datetime);
        $datetime = explode(':', $datetime);

        $this->datetime = ['day' => $datetime[0],
            'hour' => $datetime[1],
            'minutes' => $datetime[2],
            'second' => $datetime[3]];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     * @return RequestData
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->response_code;
    }

    /**
     * @param mixed $response_code
     * @return RequestData
     */
    public function setResponseCode($response_code)
    {
        $this->response_code = $response_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumntSize()
    {
        return $this->documnt_size;
    }

    /**
     * @param mixed $documnt_size
     * @return RequestData
     */
    public function setDocumntSize($documnt_size)
    {
        $this->documnt_size = $documnt_size;
        return $this;
    }



}