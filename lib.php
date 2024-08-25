<?php

defined('MOODLE_INTERNAL') || die();

/**
 * Adds a new instance of the questionextractor module.
 *
 * @param stdClass $data An object from the form
 * @param mod_questionextractor_mod_form $mform The form instance
 * @return int The id of the newly inserted record
 */
function questionextractor_add_instance($data, $mform) {
    global $DB, $OUTPUT;

    // Handle the intro editor data (intro and introformat)
    if (isset($data->introeditor)) {
        $data->intro = $data->introeditor['text'];
        $data->introformat = $data->introeditor['format'];
    }

    // Ensure other fields are correctly populated
    if (empty($data->data)) {
        $data->data = '';  // Set a default value, e.g., an empty string
    }

    $data->timecreated = time();

    // Insert the data into the 'questionextractor' table
    $instanceid = $DB->insert_record('questionextractor', $data);

    // Redirect to view.php after adding the instance
    //$url = new moodle_url('/mod/questionextractor/view.php', array('id' => $data->coursemodule));
    //redirect($url);

    return $instanceid;
}

/**
 * Updates an instance of the questionextractor module.
 *
 * @param stdClass $data An object from the form
 * @param mod_questionextractor_mod_form $mform The form instance
 * @return bool true on success, false otherwise
 */
function questionextractor_update_instance($data, $mform) {
    global $DB, $OUTPUT;

    // Handle the intro editor data (intro and introformat)
    if (isset($data->introeditor)) {
        $data->intro = $data->introeditor['text'];
        $data->introformat = $data->introeditor['format'];
    }

    // Ensure other fields are correctly populated
    if (empty($data->data)) {
        $data->data = '';  // Set a default value, e.g., an empty string
    }

    $data->timemodified = time();
    $data->id = $data->instance;

    // Update the record in the 'questionextractor' table
    $DB->update_record('questionextractor', $data);

    // Redirect to view.php after updating the instance
    //$url = new moodle_url('/mod/questionextractor/view.php', array('id' => $data->coursemodule));
    //redirect($url);

    return true;
}

/**
 * Deletes an instance of the questionextractor module.
 *
 * @param int $id The ID of the instance to delete
 * @return bool true on success, false otherwise
 */
function questionextractor_delete_instance($id) {
    global $DB;

    // Delete the record from the 'questionextractor' table
    return $DB->delete_records('questionextractor', array('id' => $id));
}
