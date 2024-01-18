<?php
class Photo {
    private $path;
    private $description;

    public function __construct($path, $description) {
        $this->path = $path;
        $this->description = $description;
    }

    public function getPath() {
        return $this->path;
    }

    public function getDescription() {
        return $this->description;
    }
}
