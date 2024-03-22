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
class Fballiano_Turnstile_Model_Observer
{
    public function verify(Varien_Event_Observer $observer): void
    {
        $helper = Mage::helper('fballiano_turnstile');
        if (!$helper->isEnabled()) {
            return;
        }

        /** @var Mage_Core_Controller_Front_Action $controller */
        $controller = $observer->getControllerAction();
        $data = $controller->getRequest()->getPost();

        $token = $data['cf-turnstile-response'] ?? '';
        if ($helper->verify($token)) {
            return;
        }

        $this->failedVerification($controller);
    }

    public function verifyAjax(Varien_Event_Observer $observer): void
    {
        $helper = Mage::helper('fballiano_turnstile');
        if (!$helper->isEnabled()) {
            return;
        }

        /** @var Mage_Core_Controller_Front_Action $controller */
        $controller = $observer->getControllerAction();
        $data = $controller->getRequest()->getPost();

        $token = $data['cf-turnstile-response'] ?? '';
        if ($helper->verify($token)) {
            return;
        }

        $this->failedVerification($controller, true);
    }

    protected function failedVerification(Mage_Core_Controller_Front_Action $controller, bool $isAjax = false): void
    {
        $controller->setFlag('', Mage_Core_Controller_Varien_Action::FLAG_NO_DISPATCH, true);
        $errorMessage = Mage::helper('fballiano_turnstile')->__('Incorrect CAPTCHA.'); //TODO find better translation

        if ($isAjax) {
            $result = ['error' => 1, 'message' => $errorMessage];
            $controller->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
            return;
        }

        Mage::getSingleton('customer/session')->addError($errorMessage);
        $request = $controller->getRequest();
        $refererUrl = $request->getServer('HTTP_REFERER');
        if ($url = $request->getParam(Mage_Core_Controller_Varien_Action::PARAM_NAME_REFERER_URL)) {
            $refererUrl = $url;
        } elseif ($url = $request->getParam(Mage_Core_Controller_Varien_Action::PARAM_NAME_BASE64_URL)) {
            $refererUrl = Mage::helper('core')->urlDecodeAndEscape($url);
        } elseif ($url = $request->getParam(Mage_Core_Controller_Varien_Action::PARAM_NAME_URL_ENCODED)) {
            $refererUrl = Mage::helper('core')->urlDecodeAndEscape($url);
        }
        $controller->getResponse()->setRedirect($refererUrl);
    }
}