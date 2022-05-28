<?php

namespace App\Models\Traits;

trait HasStudentLink
{
    public function getStudentLinks($action)
    {
        if ($action == 'show') {
            if (self::_TYPE_LINK == 'Book') {
                return 'student.library.show';
            }

            if (self::_TYPE_LINK == 'Art') {
                return 'student.museum.show';
            }
        }
    }
}
