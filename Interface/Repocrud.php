<?php

Interface RepoCrud {
    public static function nuevo($obj);
    public static function update($obj);
    public static function delete($obj);
    public static function getAll();
    public static function findByID($id);
}
