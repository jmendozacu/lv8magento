<?php
/**
 * SquareUp
 *
 * OauthToken Cron
 *
 * @category    Squareup
 * @package     Squareup_Omni
 * @copyright   2018
 * @author      SquareUp
 */

namespace Squareup\Omni\Cron;

use Squareup\Omni\Helper\Config;
use Squareup\Omni\Helper\Oauth;
use Squareup\Omni\Logger\Logger;
use Magento\Cron\Model\ResourceModel\Schedule\CollectionFactory;

/**
 * Class OauthToken
 */
class OauthToken extends AbstractCron
{
    /**
     * @var int
     */
    private $subDaysRefresh = 23;
    /**
     * @var Logger
     */
    private $logger;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var Oauth The oauth helper
     */
    public $oAuthHelper;

    /**
     * OauthToken constructor
     *
     * @param Config $config
     * @param Logger $logger
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Config $config,
        Logger $logger,
        Oauth $oAuthHelper,
        CollectionFactory $collectionFactory
    ) {
        $this->logger = $logger;
        $this->oAuthHelper = $oAuthHelper;
        parent::__construct($config);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Execute cron
     *
     * @return bool
     */
    public function execute()
    {
        $this->logger->info('Refresh Oauth Start');
        $applicationId = $this->configHelper->getApplicationId();
        $applicationSecret = $this->configHelper->getApplicationSecret();
        $authToken = $this->configHelper->getOAuthToken();
        $refreshToken = $this->configHelper->getRefreshToken();

        if (empty($applicationId) || empty($applicationSecret) || empty($authToken)) {
            return false;
        }

        $oAuthExpire = $this->configHelper->getOAuthExpire();
        if (time() < ($oAuthExpire - ($this->subDaysRefresh * (24 * 60 * 60)))) {
            return true;
        }

        $cronCollection = $this->collectionFactory->create()
            ->addFieldToFilter('job_code', ['eq' => 'oauth_refresh'])
            ->addFieldToFilter('status', ['eq' => 'running']);

        if (count($cronCollection) > 1) {
            return false;
        }

        if (null === $refreshToken) {
            // renew
            $responseObj = $this->oAuthHelper->renewToken($authToken);
        } else {
            // refresh
            $responseObj = $this->oAuthHelper->refreshToken($refreshToken);
        }

        if (false === $responseObj) {
            $this->logger->info('There was an error in the request for OAuth refresh');
            return false;
        }

        $this->configHelper->setConfig('squareup_omni/oauth_settings/oauth_token', $responseObj->access_token);
        $this->configHelper->setConfig(
            'squareup_omni/oauth_settings/oauth_expire',
            strtotime($responseObj->expires_at)
        );
        if (property_exists($responseObj, 'refresh_token')) {
            $this->configHelper->saveOauthRefresh($responseObj->refresh_token);
        }

        $this->logger->info('Refresh Oauth Finished');

        return true;
    }
}
