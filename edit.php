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

/**
 * The edit page for myhobbies.
 *
 * @package   local_myhobbies
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


