<?php
/**
 * A form for adding and editing hobbies.
 *
 * @package   local_hobbies
 * @author    John Illsley 2021
 */

namespace local_myhobbies\forms;

use moodleform;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

class edit_hobby extends moodleform {

    function definition() {

        $mform = $this->_form;

        $mform->addElement(
            'text',
            'title',
            get_string('heading_hobbies_title', 'local_myhobbies'),
            array('maxlength' => 100)
        );
        $mform->setType('title', PARAM_TEXT);
        $mform->addRule('title', get_string('required'), 'required', null, 'client');
        $mform->addRule('title', get_string('maximumchars', '', 100), 'maxlength', 100, 'client');

        $mform->addElement(
            'editor',
            'description',
            get_string('heading_hobbies_description', 'local_myhobbies')
        );
        $mform->setType('description', PARAM_RAW);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $this->add_action_buttons(true, get_string('save_hobby', 'local_myhobbies'));
    }
}