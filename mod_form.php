<?php

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_questionextractor_mod_form extends moodleform_mod {
    
    public function definition() {
        $mform = $this->_form;

        // Add a text field for the instance name
        $mform->addElement('text', 'name', get_string('name', 'questionextractor'), array('size' => '64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        // Add the intro editor (includes intro and introformat)
        $this->standard_intro_elements();

        // Add a textarea for the 'data' field
        $mform->addElement('textarea', 'data', get_string('data', 'questionextractor'), 'wrap="virtual" rows="10" cols="50"');
        $mform->setType('data', PARAM_TEXT);  // Set the data type
        $mform->addRule('data', null, 'required', null, 'client');  // Make the data field required

        // Add standard elements common to all modules (like availability, ID number, etc.)
        $this->standard_coursemodule_elements();

        // Add standard buttons (save and cancel)
        $this->add_action_buttons();
    }
}
