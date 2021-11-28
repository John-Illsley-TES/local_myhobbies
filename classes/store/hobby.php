<?php
/**
 * Store for hobbies.
 *
 * @package   local_hobbies
 */

namespace local_myhobbies\store;

use coding_exception;
use dml_exception;
use stdClass;

defined('MOODLE_INTERNAL') || die();

class hobby {

    const MAX_TITLE_LENGTH  = 100;
    const DB_TABLE          = 'local_myhobbies';

    /**
     * Constructor.
     */
    public function __construct() {

    }

    /**
     * Insert or updates a hobby record.
     *
     * @param string $title
     * @param string $description
     * @param int $userid
     * @param int|null $id if set then this record is updated.
     * @return int
     * @throws coding_exception
     * @throws dml_exception
     */
    public function save(
        string $title,
        string $description,
        int $userid,
        int $id = null): int {

        global $DB;

        if (strlen($title) > self::MAX_TITLE_LENGTH) {
            throw new coding_exception('The hobby name is too long to store.');
        }
        $hobby = new stdClass();
        $hobby->title       = $title;
        $hobby->description = $description;
        $hobby->userid      = $userid;
        $hobby->timeupdated = time();

        if (!empty($id)) {
            $hobby->id = $id;
            $DB->update_record(self::DB_TABLE, $hobby);
        } else {
            $hobby->timecreated = $hobby->timeupdated;
            $id = $DB->insert_record(self::DB_TABLE, $hobby);
        }
        return $id;
    }

    /**
     * Gets a hobby by id. The userid must be associated with the record or returns false.
     *
     * @param int $id
     * @param int $userid
     * @return stdClass
     * @throws dml_exception
     */
    public function get(int $id, int $userid): stdClass {
        global $DB;

        return $DB->get_record(self::DB_TABLE, array('id' => $id, 'userid' => $userid));
    }

    /**
     * Gets all the hobbies for a user.
     *
     * @param int $userid
     * @return array
     * @throws dml_exception
     */
    public function get_all(int $userid): array {
        global $DB;

        return $DB->get_records(self::DB_TABLE, array('userid' => $userid), 'id ASC');
    }

    /**
     * Delete a hobby record. The record must belong to the user.
     *
     * @param int $id
     * @param int $userid
     * @return bool
     * @throws dml_exception
     */
    public function delete(int $id, int $userid) {
        global $DB;

        return $DB->delete_records(self::DB_TABLE, array('id' => $id, 'userid' => $userid));
    }
}
