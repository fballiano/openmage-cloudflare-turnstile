<?php
/**
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Fballiano
 * @package    Fballiano_Turnstile
 * @copyright  Copyright (c) 2024 Fabrizio Balliano (https://fabrizioballiano.com)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Fballiano_Turnstile_Helper_Data extends Mage_Core_Helper_Abstract
{
    public const XML_PATH_ENABLE = "admin/fballiano_turnstile/enable";
    public const XML_PATH_SITE_KEY = "admin/fballiano_turnstile/site_key";
    public const XML_PATH_SECRET_KEY = "admin/fballiano_turnstile/secret_key";
    public const XML_PATH_FRONTEND_SELECTORS = "admin/fballiano_turnstile/selectors";
    public const VERIFY_URL = "https://challenges.cloudflare.com/turnstile/v0/siteverify";

    public function getSiteKey(): string
    {
        return Mage::getStoreConfig(self::XML_PATH_SITE_KEY);
    }

    public function getSecretKey(): string
    {
        return Mage::getStoreConfig(self::XML_PATH_SECRET_KEY);
    }

    public function getFrontendSelectors(): string
    {
        $selectors = Mage::getStoreConfig(self::XML_PATH_FRONTEND_SELECTORS) ?? '';
        return preg_replace("/\r\n|\r|\n/", ",", trim($selectors));
    }

    public function verify(string $token, string $IpAddress = null): bool
    {
        if (!$token) {
            return false;
        }

        if ($IpAddress === null) {
            $IpAddress = Mage::helper('core/http')->getRemoteAddr();
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, SELF::VERIFY_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            "secret" => $this->getSecretKey(),
            "response" => $token,
            "remoteip" => $IpAddress
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $curlErrors = curl_errno($ch);
        curl_close($ch);

        if ($curlErrors) {
            return false;
        }

        $response = json_decode($response,true);
        if ($response["success"] === true) {
            return true;
        }

        return false;
    }

    public function isEnabled(): bool
    {
        return $this->isModuleEnabled() && $this->isModuleOutputEnabled() && Mage::getStoreConfigFlag(self::XML_PATH_ENABLE);
    }
}
