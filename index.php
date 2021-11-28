<?php

/**
 * The index page for myhobbies.
 *
 * @package   local_hobbies
 * @author    John Illsley 2021
 */

require_once('../../config.php');

require_login();

$delete = optional_param('delete', null, PARAM_INT);
$url = new moodle_url($CFG->wwwroot . '/local/myhobbies/index.php');
$hobbystore = new \local_myhobbies\store\hobby();

if (isset($delete)) {
    $hobbystore->delete($delete, $USER->id);
    redirect($url);
}
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('My Hobbies');
$PAGE->set_url($url);

$usershobbies = $hobbystore->get_all($USER->id);

$output = $PAGE->get_renderer('local_myhobbies');

echo $output->header();
echo $output->hobbies_list($usershobbies);
echo $output->footer();