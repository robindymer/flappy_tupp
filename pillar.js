class Pillar {
  constructor() {
    this.sweepSpeed = 2;
    this.x = width+50;
    this.y = 0;
    this.w = -50;
    this.h = random(20, height-142);
  }
  show() {
    // Also have a spacing of 40 px
    // Take random amount of height, then rest is height - randHeight - 40
    fill(44, 176, 26);
    rect(this.x-this.sweepSpeed,this.y,this.w,this.h);
    rect(this.x-this.sweepSpeed,this.h+140,this.w,height);
    this.x -= this.sweepSpeed;
  }
  // Out of bounds
  oob() {
    if(this.x < 0) {
      return true;
    } else {
      return false;
    }
  }
}