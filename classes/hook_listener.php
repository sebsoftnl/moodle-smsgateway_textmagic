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

namespace smsgateway_textmagic;

use core_sms\hook\after_sms_gateway_form_hook;

/**
 * Hook listener for textmagic sms gateway.
 *
 * @package    smsgateway_textmagic
 * @copyright  2024 RvD <helpdesk@sebsoft.nl>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class hook_listener {

    /**
     * Hook listener for the sms gateway setup form.
     *
     * @param after_sms_gateway_form_hook $hook The hook to add to sms gateway setup.
     */
    public static function set_form_definition_for_textmagic_sms_gateway(after_sms_gateway_form_hook $hook): void {
        if ($hook->plugin !== 'smsgateway_textmagic') {
            return;
        }

        $mform = $hook->mform;

        $mform->addElement('static', 'information', get_string('textmagic_information', 'smsgateway_textmagic'));

        $mform->addElement(
            'text',
            'username',
            get_string('username'),
            'maxlength="255" size="20"',
        );
        $mform->setType('username', PARAM_TEXT);
        $mform->addRule('username', get_string('maximumchars', '', 255), 'maxlength', 255);
        $mform->setDefault(
            elementName: 'username',
            defaultValue: '',
        );

        $mform->addElement(
            'passwordunmask',
            'apikey',
            get_string('apikey', 'smsgateway_textmagic'),
            'maxlength="255" size="20"',
        );
        $mform->setType('apikey', PARAM_TEXT);
        $mform->addRule('apikey', get_string('maximumchars', '', 255), 'maxlength', 255);
        $mform->setDefault(
            elementName: 'apikey',
            defaultValue: '',
        );
    }

}
