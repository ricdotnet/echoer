<?php

namespace App\Router;

class Response {

  private static string $response;
//  private static int $status; // currently use http_response_code()

  /**
   * Set the response body
   *
   * @param string $response
   * @return void
   */
  static function setResponse(string $response = "empty") {
    self::$response = $response;
  }

  static function getResponse(): string {
    return self::$response;
  }

  /**
   * Set the status code
   *
   * @param int $status
   * @return void
   */
  static function setStatus(int $status) {
    http_response_code($status);
  }

  /**
   * Set a new header
   *
   * @param string $header
   * @return void
   */
  static function setHeader(string $header) {
    header($header);
  }

}