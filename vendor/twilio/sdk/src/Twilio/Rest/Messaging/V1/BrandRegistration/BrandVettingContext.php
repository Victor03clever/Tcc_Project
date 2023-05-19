<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Messaging
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Messaging\V1\BrandRegistration;

use Twilio\Exceptions\TwilioException;
use Twilio\Version;
use Twilio\InstanceContext;


class BrandVettingContext extends InstanceContext
    {
    /**
     * Initialize the BrandVettingContext
     *
     * @param Version $version Version that contains the resource
     * @param string $brandSid The SID of the Brand Registration resource of the vettings to create .
     * @param string $brandVettingSid The Twilio SID of the third-party vetting record.
     */
    public function __construct(
        Version $version,
        $brandSid,
        $brandVettingSid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'brandSid' =>
            $brandSid,
        'brandVettingSid' =>
            $brandVettingSid,
        ];

        $this->uri = '/a2p/BrandRegistrations/' . \rawurlencode($brandSid)
        .'/Vettings/' . \rawurlencode($brandVettingSid)
        .'';
    }

    /**
     * Fetch the BrandVettingInstance
     *
     * @return BrandVettingInstance Fetched BrandVettingInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): BrandVettingInstance
    {

        $payload = $this->version->fetch('GET', $this->uri);

        return new BrandVettingInstance(
            $this->version,
            $payload,
            $this->solution['brandSid'],
            $this->solution['brandVettingSid']
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Messaging.V1.BrandVettingContext ' . \implode(' ', $context) . ']';
    }
}
