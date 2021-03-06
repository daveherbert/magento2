<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright  Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Oauth;

/**
 * Interface TokenProviderInterface
 *
 * This interface provides token manipulation, such as creating a request token and getting an access token as well
 * as methods for performing certain validations on tokens and token requests. Consumer methods are also provided to
 * help clients manipulating tokens validate and acquire the associated token consumer.
 *
 * @package Magento\Oauth
 */
interface TokenProviderInterface
{
    /**
     * Validate the consumer.
     *
     * @param ConsumerInterface $consumer - The consumer.
     * @return bool - True if the consumer is valid.
     * @throws \Magento\Oauth\Exception - Validation errors.
     */
    public function validateConsumer($consumer);

    /**
     * Create a request token for the specified consumer.
     *
     * @param ConsumerInterface $consumer
     * @return array - The request token and secret.
     * <pre>
     *     array(
     *         'oauth_token' => 'gshsjkndtyhwjhdbutfgbsnhtrequikf,
     *         'oauth_token_secret' => 'gshsjkndtyhwjhdbutfgbsnhtrequikf'
     *     )
     * </pre>
     * @throws \Magento\Oauth\Exception - Validation errors.
     */
    public function createRequestToken($consumer);

    /**
     * Validates the request token and verifier. Verifies the request token is associated with the consumer.
     *
     * @param string $requestToken - The 'oauth_token' request token value.
     * @param ConsumerInterface $consumer - The consumer given the 'oauth_consumer_key'.
     * @param string $oauthVerifier - The 'oauth_verifier' value.
     * @return string - The request token secret (i.e. 'oauth_token_secret').
     * @throws \Magento\Oauth\Exception - Validation errors.
     */
    public function validateRequestToken($requestToken, $consumer, $oauthVerifier);

    /**
     * Retrieve access token for the specified consumer given the consumer key.
     *
     * @param ConsumerInterface $consumer - The consumer given the 'oauth_consumer_key'.
     * @return array - The access token and secret.
     * <pre>
     *     array(
     *         'oauth_token' => 'gshsjkndtyhwjhdbutfgbsnhtrequikf,
     *         'oauth_token_secret' => 'gshsjkndtyhwjhdbutfgbsnhtrequikf'
     *     )
     * </pre>
     * @throws \Magento\Oauth\Exception - Validation errors.
     */
    public function getAccessToken($consumer);

    /**
     * Validates the Oauth token type and verifies that it's associated with the consumer.
     *
     * @param string $accessToken - The 'oauth_token' access token value.
     * @param ConsumerInterface $consumer - The consumer given the 'oauth_consumer_key'.
     * @return string - The access token secret.
     * @throws \Magento\Oauth\Exception - Validation errors.
     */
    public function validateAccessTokenRequest($accessToken, $consumer);

    /**
     * Validate an access token string.
     *
     * @param string - The 'oauth_token' access token string.
     * @return int - Consumer ID if the access token is valid.
     * @throws \Magento\Oauth\Exception - Validation errors.
     */
    public function validateAccessToken($accessToken);

    /**
     * Perform basic validation of an Oauth token, of any type (e.g. request, access, etc.).
     *
     * @param string $oauthToken - The token string.
     * @return bool - True if the Oauth token passes basic validation.
     */
    public function validateOauthToken($oauthToken);

    /**
     * Retrieve a consumer given the consumer's key.
     *
     * @param string $consumerKey - The 'oauth_consumer_key' value.
     * @return ConsumerInterface
     * @throws \Magento\Oauth\Exception
     */
    public function getConsumerByKey($consumerKey);
}
