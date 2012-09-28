<?php

class ehAuthUserAgent extends Browser
{
  public function __toString()
  {
    return $this->getUserAgent();
  }
}