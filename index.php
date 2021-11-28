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
 * The index page for myhobbies.
 *
 * @package   local_myhobbies
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