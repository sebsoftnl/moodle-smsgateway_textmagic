<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace smsgateway_textmagic\local\service;

use core_sms\message_status;
use smsgateway_textmagic\helper;
use smsgateway_textmagic\local\textmagic_sms_service_provider;
use stdClass;
use TextMagic\Models\SendMessageInputObject;
use TextMagic\Api\TextMagicApi;
use TextMagic\Configuration;
use GuzzleHttp\Client;
use Exception;


/**
 * textmagic SNS service provider.
 *
 * @package    smsgateway_textmagic
 * @copyright  2025 SB <helpdesk@sebsoft.nl>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class textmagic_sms implements textmagic_sms_service_provider {

    /**
     * Include the required calls.
     */
    private static function require(): void {
        global $CFG;
        require_once($CFG->dirroot . '/sms/gateway/textmagic/vendor/autoload.php');
    }

    #[\Override]
    public static function send_sms_message(
        string $messagecontent,
        string $phonenumber,
        stdclass $config,
    ): message_status {
        global $SITE;
        self::require();

        try {
            // Set up the sender information.
            $senderid = $SITE->shortname;
            // Remove spaces and non-alphanumeric characters from ID.
            $senderid = preg_replace("/[^A-Za-z0-9]/", '', trim($senderid));
            // We have to truncate the senderID to 11 chars.
            $senderid = substr($senderid, 0, 11);

            // See https://github.com/textmagic/textmagic-rest-php-v2.

            // Put your Username and API Key from https://my.textmagic.com/online/api/rest-api/keys page.
            $config = Configuration::getDefaultConfiguration()
                ->setUsername($config->username)
                ->setPassword($config->apikey);
            $api = new TextMagicApi(
                new Client(),
                $config
            );

            // Simple ping request example.
            $api->ping();
            // Send a new message request example.
            $input = new SendMessageInputObject();
            $input->setText($messagecontent);
            $input->setPhones($phonenumber);

            $result = $api->sendMessage($input);
            
            // Check if we have a message ID in the response
            if (!empty($result->getId())) {
                //debugging('TextMagic message sent successfully with ID: ' . $result->getId());
                return message_status::GATEWAY_SENT;
            }

            // If we get here, something went wrong but didn't throw an exception
            debugging('TextMagic API call succeeded but no message ID was returned');
            return message_status::GATEWAY_ERROR;

        } catch (textmagic\Exceptions\AuthenticateException $aex) {
            debugging('TextMagic authentication failed: ' . $aex->getMessage() . "\n" . $aex->getTraceAsString());
            return message_status::GATEWAY_NOT_AVAILABLE;
        } catch (textmagic\Exceptions\BalanceException $bex) {
            debugging('TextMagic insufficient balance: ' . $bex->getMessage() . "\n" . $bex->getTraceAsString());
            return message_status::GATEWAY_NOT_AVAILABLE;
        } catch (\Exception $e) {
            debugging('TextMagic unexpected error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return message_status::GATEWAY_NOT_AVAILABLE;
        }
    }
}
