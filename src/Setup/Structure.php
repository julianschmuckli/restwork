<?php
namespace Julianschmuckli\Restwork\Setup;

class Structure {
    /**
     * Does the setup of the folder structure.
     */
    public static function setup() {
        echo "Setup the folder structure.";
        mkdir("./dao", 0777, true);
        mkdir("./routes", 0777, true);
        mkdir("./services", 0777, true);
        mkdir("./entities", 0777, true);
    }
}