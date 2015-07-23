<?php
namespace Kemer\MediaLibrary\Item;

/**
 * The ConnectionManager service defines the notion of “Protocol Info” as information
 * needed by a control point in order to determine (a certain level of) compatibility
 * between the streaming mechanisms of two UPnP controlled devices. For example,
 * it contains the transport protocols supported by a device, for input or output,
 * as well as other information such as the content formats (encodings) that can be sent,
 * or received, via the transport protocols. Note that, while UPnP prescribes
 * the use of HTTP for controlling devices via SOAP, it does not require HTTP
 * to be used for all kinds (Audio and Video) streaming in a UPnP network.
 * In the context of this document, the term “protocol info” is used to describe
 * as a string formatted as:
 * <protocol>’:’ <network>’:’<contentFormat>’:’<additionalInfo>
 */
interface ProtocolInfoInterface
{
    const PROTOCOL_HTTP_GET = "http-get";
    const PROTOCOL_RTSP_RTP_UDP = "rtsp-rtp-udp";
    const PROTOCOL_INTERNAL = "internal";
    const PROTOCOL_IEC61883 = "iec61883";

    public function setProtocol($protocol);

    public function getProtocol();

    public function setNetwork($network);

    public function getNetwork();

    public function setContentFormat($contentFormat);

    public function getContentFormat();

    public function setAdditionalInfo($additionalInfo);

    public function getAdditionalInfo();
}
