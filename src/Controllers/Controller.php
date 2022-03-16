<?php

namespace App\Controllers;

class Controller {

  private ?\stdClass $object = null;

  /**
   * This function creates a json object with the values passed in.
   * It first checks for a null $object and if it is null then it creates one.
   *
   * @param string $key
   * @param string|int $value
   * @return $this
   */
  function append(string $key, string|int $value): static {

    if ($this->object == null) {
      $this->object = new \stdClass();
    }

    $this->object->$key = $value;
    return $this;
  }

  function send(): bool|string {
    return json_encode($this->object);
  }

}