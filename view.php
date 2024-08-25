<?php

require_once('../../config.php');
require_once($CFG->dirroot.'/mod/questionextractor/lib.php');

$id = optional_param('id', 0, PARAM_INT); // Course module ID

if ($id) {
    $cm = get_coursemodule_from_id('questionextractor', $id, 0, false, MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $questionextractor = $DB->get_record('questionextractor', array('id' => $cm->instance), '*', MUST_EXIST);
} else {
    throw new moodle_exception('missingparameter');
}
require_login($course, true, $cm);

$PAGE->set_url('/mod/questionextractor/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($questionextractor->name));
$PAGE->set_heading(format_string($course->fullname));

echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($questionextractor->name));

// Display the intro content
if (!empty($questionextractor->intro)) {
    echo $OUTPUT->box(format_text($questionextractor->intro, $questionextractor->introformat), 'generalbox mod_introbox');
}

// Display additional fields
if (!empty($questionextractor->data)) {
    echo $OUTPUT->box(format_text($questionextractor->data), 'generalbox');
}

// Check if the user can manage this module
if (has_capability('mod/questionextractor:manage', $PAGE->context)) {
    $editurl = new moodle_url('/mod/questionextractor/edit.php', array('id' => $cm->id));
    $deleteurl = new moodle_url('/mod/questionextractor/delete.php', array('id' => $cm->id));
    echo $OUTPUT->single_button($editurl, get_string('edit'), 'get');
    echo $OUTPUT->single_button($deleteurl, get_string('delete'), 'post');
}

// Add a back to course button
echo $OUTPUT->single_button(new moodle_url('/course/view.php', array('id' => $course->id)), get_string('backtocourse', 'moodle'), 'get');

echo $OUTPUT->footer();
