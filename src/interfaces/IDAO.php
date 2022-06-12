<?php
namespace Julianschmuckli\Restwork;

interface DAO
{
    /**
     * Provides the database object to the DAO.
     */
    public function __construct(DB $db);
}
