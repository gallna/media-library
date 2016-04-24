<?php
namespace Kemer\MediaLibrary;

class ProtocolInfo implements ProtocolInfoInterface
{
    private $protocol;
    private $network;
    private $contentFormat;
    private $additionalInfo;

    public function __construct($protocolInfo = null)
    {
        if ($protocolInfo && is_string($protocolInfo)) {
            $this->fromString($protocolInfo);
        }
    }

    public function fromString($protocolInfo)
    {
        $protocols = [];
        foreach (explode(",", $protocolInfo) as $protocol) {
            $info = explode(":", $protocol);
            $protocol = new static();
            $protocol->setProtocol($info[0]);
            $protocol->setNetwork($info[1]);
            $protocol->setContentFormat($info[2]);
            $protocol->setAdditionalInfo($info[3]);
            $this->protocols[] = $protocol;
        }
    }

    public function __toString()
    {
        return implode(":", [
            $this->getProtocol(),
            $this->getNetwork(),
            $this->getContentFormat(),
            $this->getAdditionalInfo(),
            ]);
    }

    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        return $this;
    }

    public function getProtocol()
    {
        return $this->protocol;
    }

    public function setNetwork($network)
    {
        $this->network = $network;
        return $this;
    }

    public function getNetwork()
    {
        return $this->network;
    }

    public function setContentFormat($contentFormat)
    {
        $this->contentFormat = $contentFormat;
        return $this;
    }

    public function getContentFormat()
    {
        return $this->contentFormat;
    }

    public function setAdditionalInfo($additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    /**
     * Create Object from an array
     *
     * @param array $data
     * @return object
     */
    public static function fromArray(array $data)
    {
        return (new ProtocolInfo())
            ->setProtocol(isset($data["protocol"]) ? $data["protocol"] : null)
            ->setNetwork(isset($data["network"]) ? $data["network"] : null)
            ->setContentFormat(isset($data["contentFormat"]) ? $data["contentFormat"] : null)
            ->setAdditionalInfo(isset($data["additionalInfo"]) ? $data["additionalInfo"] : null);
    }
}
