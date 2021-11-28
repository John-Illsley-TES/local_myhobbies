<?php

/**
 * The edit page for myhobbies.
 *
 * @package   local_hobbies
 * @author    John Illsley 2021
 */

require_once('../../config.php');

require_login();

$id = optional_param('id', null, PARAM_INT);

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Edit Hobby');
$PAGE->set_url($CFG->wwwroot . '/local/myhobbies/edit.php');

$mform = new \local_myhobbies\forms\edit_hobby();
$listurl = new moodle_url($CFG->wwwroot . '/local/myhobbies/index.php');
$hobbystore = new \local_myhobbies\store\hobby();

if ($mform->is_cancelled()) {
    redirect($listurl);
} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    $hobbystore->save(
        $fromform->title,
        $fromform->description['text'],
        $USER->id,
        $fromform->id
    );
    redirect($listurl);
} else {
    $toform = new stdClass();
    if (!empty($id)) {
        $hobby = $hobbystore->get($id, $USER->id);
        $toform->id                     = $hobby->id;
        $toform->title                  = $hobby->title;
        $toform->description['text']    = $hobby->description;

        $mform->set_data($toform);
    }

    echo $OUTPUT->header();
    $mform->display();
    echo $OUTPUT->footer();
}
