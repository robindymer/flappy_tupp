class Tupp {
  constructor() {
    this.x = width/2-30;
    this.y = height/2;
    this.pos = createVector(this.x, this.y);
    this.gravity = createVector(0, 0.3);
    this.vel = createVector(0, 0);
  }
  show() {
    imageMode(CENTER);
    image(tuppImg, this.pos.x, this.pos.y, 80, 80);

    fill(200, 0, 200, 100);

    // DEBUG
    // rect(this.pos.x, this.pos.y-25, 35, 50);
    // rect(this.pos.x-35, this.pos.y-10, 35, 35)
    // line(0,0,this.pos.x-35, this.pos.y-10)
    // line(0,0,this.pos.x-35, this.pos.y+25)
    // if (currentPillar) {
    //   line(0,0,this.pos.x-35, currentPillar.h)
    //   line(0,0,this.pos.x-35, currentPillar.h+140)
    // }

    rectMode(CORNER);
  }
  move() {
    this.vel.add(this.gravity);
    this.pos.add(this.vel);
    // line(0, 0, this.pos.x, this.pos.y)
    // line(0, 0, this.pos.x, this.pos.y-25)
  }
  flap() {
    // Sets vel to -6, stopping it from falling
    this.vel = createVector(0, -6);
  }
  collided() {
    // Check if the first part of the hitbox has collided with the pillar
    if((this.pos.y-25 < currentPillar.h || this.pos.y+25 > currentPillar.h+140) && (inside) && (hitboxOne)) {
      // Debug graphics
      // line(width/2, this.pos.y-25, width/2, this.pos.y+25)
      // line(width/2-40, currentPillar.h, width/2-40, currentPillar.h+140)
      // line(this.pos.x+25, height/2, this.pos.x-25, height/2)
      return true;
    } else if((this.pos.y-10 < currentPillar.h || this.pos.y+25 > currentPillar.h+140) && (inside) && (hitboxTwo)) {
      // This check the second part of the hitbox
      return true;
    } else {
      // console.log([this.x, currentPillar.x])
      return false;
    }
  }
  oob() {
    if (this.pos.y > height || this.pos.y < 0) {
      return true;
    } else {
      return false;
    }
  }
}