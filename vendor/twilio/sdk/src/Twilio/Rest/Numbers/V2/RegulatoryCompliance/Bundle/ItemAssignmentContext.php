<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Numbers
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Numbers\V2\RegulatoryCompliance\Bundle;

use Twilio\Exceptions\TwilioException;
use Twilio\Version;
use Twilio\InstanceContext;


class ItemAssignmentContext extends InstanceContext
    {
    /**
     * Initialize the ItemAssignmentContext
     *
     * @param Version $version Version that contains the resource
     * @param string $bundleSid The unique string that we created to identify the Bundle resource.
     * @param string $sid The unique string that we created to identify the Identity resource.
     */
    public function __construct(
        Version $version,
        $bundleSid,
        $sid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'bundleSid' =>
            $bundleSid,
        'sid' =>
            $sid,
        ];

        $this->uri = '/RegulatoryCompliance/Bundles/' . \rawurlencode($bundleSid)
        .'/ItemAssignments/' . \rawurlencode($sid)
        .'';
    }

    /**
     * Delete the ItemAssignmentInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->version->delete('DELETE', $this->uri);
    }


    /**
     * Fetch the ItemAssignmentInstance
     *
     * @return ItemAssignmentInstance Fetched ItemAssignmentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): ItemAssignmentInstance
    {

        $payload = $this->version->fetch('GET', $this->uri);

        return new ItemAssignmentInstance(
            $this->version,
            $payload,
            $this->solution['bundleSid'],
            $this->solution['sid']
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
        return '[Twilio.Numbers.V2.ItemAssignmentContext ' . \implode(' ', $context) . ']';
    }
}
