<?php
/*
 * Copyright 2016, Ekin K. <sudo@gmx.fr>
 *
 * Documentation:
 * https://github.com/iamdual/upload
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace iamdual;

class Upload {

    /**
     * Error messages
     * @var array
     */
    private $error_messages = array(
        "empty_file" => "File not selected.",
        "invalid_ext" => "Invalid file extension.",
        "invalid_type" => "Invalid file type.",
        "long_size" => "The file size is too large.",
        "file_exists" => "File already exists.",
        "unknown_error" => "Unknown error.",
    );

    /**
     * @var string
     */
    private $error = null;

    /**
     * @var array
     */
    private $file = null;

    /**
     * @var array
     */
    private $extensions = null;

    /**
     * @var array
     */
    private $disallowed_extensions = null;

    /**
     * @var array
     */
    private $types = null;

    /**
     * @var array
     */
    private $disallowed_types = null;

    /**
     * @var int
     */
    private $max_size = null;

    /**
     * @var string
     */
    private $path = null;

    /**
     * @var string
     */
    private $new_name = null;

    /**
     * @var boolean
     */
    private $override = false;

    /**
     * $_FILES or custom file array
     * @param string $file
     */
    function __construct($file) {

        $this->file = $file;

        return $this;
    }

    /**
     * Allowed file extensions (Example: png, gif, jpg)
     * @param array $extensions
     * @return $this
     */
    public function allowed_extensions($extensions) {

        $this->extensions = (is_array($extensions) ? $extensions : null);

        return $this;
    }

    /**
     * Disllowed file extensions (Example: html, php, dmg)
     * @param array $extensions
     * @return $this
     */
    public function disallowed_extensions($extensions) {

        $this->disallowed_extensions = (is_array($extensions) ? $extensions : null);

        return $this;
    }

    /**
     * Allowed mime types (Example: image/png, image/jpeg)
     * @param array $types
     * @return $this
     */
    public function allowed_types($types) {

        $this->types = (is_array($types) ? $types : null);

        return $this;
    }

    /**
     * Disllowed mime types
     * @param array $types
     * @return $this
     */
    public function disallowed_types($types) {

        $this->disallowed_types = (is_array($types) ? $types : null);

        return $this;
    }

    /**
     * Maximum file size in MB
     * @param int $size
     * @return $this
     */
    public function max_size($size) {

        $this->max_size = (is_numeric($size) ? $size : null);

        return $this;
    }

    /**
     * Override (write over) the file with the same name
     * @param boolean $override
     * @return $this
     */
    public function override($override) {

        $this->override = ($override === true ? true : false);

        return $this;
    }

    /**
     * The path where files will be uploaded
     * @param string $path
     * @return $this
     */
    public function path($path) {

        $this->path = $path;

        return $this;
    }

    /**
     * The new name of the uploaded file (Example: newbie)
     * @param string $name
     * @return $this
     */
    public function new_name($name) {

        $this->new_name = $name . "." . $this->get_ext($this->file["name"]);

        return $this;
    }

    /**
     * Get uploaded file name
     * @return string
     */
    public function get_name() {

        if ($this->new_name === null) {

            return $this->file["name"];

        }
        else {

            return $this->new_name;

        }

    }

    /**
     * Check the file with the same name
     * @return boolean
     */
    public function is_exists() {
        if (file_exists($this->get_path($this->get_name()))) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Check the file can be uploaded
     * @return boolean
     */
    public function check() {

        if (!isset($this->file["name"]) || !isset($this->file["tmp_name"]) || !isset($this->file["type"]) || !isset($this->file["size"]) || !isset($this->file["error"])) {
            $this->error = $this->error_messages["empty_file"];
        }
        else if (strlen($this->file["name"]) == 0 || strlen($this->file["tmp_name"]) == 0 || strlen($this->file["type"]) == 0) {
            $this->error = $this->error_messages["empty_file"];
        }
        else if ($this->extensions !== null && !in_array($this->get_ext($this->file["name"]), $this->extensions)) {
            $this->error = $this->error_messages["invalid_ext"];
        }
        else if ($this->disallowed_extensions !== null && in_array($this->get_ext($this->file["name"]), $this->disallowed_extensions)) {
            $this->error = $this->error_messages["invalid_type"];
        }
        else if ($this->types !== null && !in_array($this->file["type"], $this->types)) {
            $this->error = $this->error_messages["invalid_type"];
        }
        else if ($this->disallowed_types !== null && in_array($this->file["type"], $this->disallowed_types)) {
            $this->error = $this->error_messages["invalid_type"];
        }
        else if ($this->max_size !== null && $this->file["size"] > $this->mb_to_byte($this->max_size)) {
            $this->error = $this->error_messages["long_size"];
        }
        else if ($this->file["error"] == 1 || $this->file["error"] == 2) {
            $this->error = $this->error_messages["long_size"];
        }
        else if ($this->file["error"] == 4) {
            $this->error = $this->error_messages["empty_file"];
        }
        else if ($this->file["error"] > 0) {
            $this->error = $this->error_messages["unknown_error"];
        }

        if ($this->error === null) {
            return true;
        }
        else {
            return false;
        }

    }

    /**
     * Get error message
     * @return string
     */
    public function error() {

        return $this->error;

    }

    /**
     * Upload the file.
     * @return boolean
     */
    public function upload() {

        if ($this->check()) {

            if (! file_exists($this->get_path())) {
                mkdir($this->get_path(), 0777, true);
            }

            $filepath = $this->get_path($this->get_name());

            if ($this->override === false && file_exists($filepath)) {

                $fileinfo = pathinfo($filepath);
                $filename = $fileinfo['filename'];
                $fileextn = strtolower($fileinfo['extension']);

                $number = 0;
                do {
                    $filepath = $this->get_path($filename . ($number ? "_{$number}" : "") . "." . $fileextn);
                    $number++;
                } while(file_exists($filepath));

                $this->new_name = pathinfo($filepath, PATHINFO_BASENAME);

            }

            @move_uploaded_file($this->file["tmp_name"], $filepath);

            return true;

        }
        else {

            return false;

        }

    }

    /**
     * Get the full path of the uploaded file
     * @return string
     */
    public function get_path($filename = null) {

        $path = null;

        if ($this->path !== null) {
            $path = rtrim($this->path, "/") . "/";
        }

        if ($filename !== null) {
            $filename = rtrim($filename, "/");
        }

        return $path . $filename;

    }

    /**
     * @return string
     */
    private function get_ext($filename) {

        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    }

    /**
     * @return int
     */
    private function mb_to_byte($filesize) {

        return $filesize * pow(1024, 2);

    }

}
