<?php

namespace App\Controllers;

class Controller {

  private ?\stdClass $object = null;

  /**
   * Set content-type to json and start an object.
   * It first checks for a null $object and if it is null then it creates one.
   *
   * @return Controller
   */
  function json(): Controller {
    header("Content-Type: application/json");
    if ($this->object == null) {
      $this->object = new \stdClass();
    }

    return $this;
  }

  /**
   * This function creates a json object with the values passed in.
   *
   * @param string $key
   * @param string|int $value
   * @return $this
   */
  function append(string $key, string|int $value): Controller {
    $this->object->$key = $value;
    return $this;
  }

  /**
   * This function encodes and sends the built object.
   *
   * @return bool|string
   */
  function send(): bool|string {
    return json_encode($this->object);
  }

}