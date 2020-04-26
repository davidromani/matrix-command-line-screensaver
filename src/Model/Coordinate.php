<?php

namespace App\Model;

class Coordinate
{
  private int $x;

  private int $y;

  public function __construct(int $x, int $y)
  {
    $this->x = $x;
    $this->y = $y;
  }

  public static function buildFromArray(array $coordinates): Coordinate
  {
    $coordinate = new Coordinate(0, 0);
    $coordinate->setX($coordinates[0]);
    $coordinate->setY($coordinates[1]);

    return $coordinate;
  }

  public function getX(): int
  {
    return $this->x;
  }

  public function setX(int $x): self
  {
    $this->x = $x;

    return $this;
  }

  public function getY(): int
  {
    return $this->y;
  }

  public function setY(int $y): self
  {
    $this->y = $y;

    return $this;
  }

  public function __toString()
  {
    return '[x:'.$this->x.' , y:'.$this->y.']';
  }
}
