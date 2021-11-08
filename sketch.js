let tupp;
let tuppImg;
let currentPillar;
let inside = false;
let inside2 = false;
let score = 0;
let imgpos = 700;
let start = false;
let hitboxOne = true;
let hitboxTwo = false;
let gameOver = false;

let inconsolata;
let flap;
let dead;
let backimg;

let pillars = [];

function preload() {
  tuppImg = loadImage("tupp.png");
  inconsolata = loadFont('assets/Inconsolata.otf');
  flap = loadSound('assets/flapsound.mp3');
  dead = loadSound('assets/tuppsound.mp3');
  backimg = loadImage("assets/angstrompixel.png")
}

function addPillar() {
  let newPillar = new Pillar();
  pillars.push(newPillar);
}

function setup() {
  //frameRate(30)
  // !!!! 700 VAR DEN !!!! (lär bli skumt med pelarna nu)
  createCanvas(500, 600);
  textFont(inconsolata);
  tupp = new Tupp();
  pillar = new Pillar();
  
  createElement('h1', 'Flappy tupp!');
  createP('Reglerna är enkla: Flyg längs ångan så långt som du kan utan att döda tuppen');
  button = createButton('Starta spelet').class('button');
  let div = createDiv().class('wrapper');
  div.child(button);
  button.mousePressed(() => {
    if (!start) {
      setInterval(addPillar, 2000);
      start = true;
      loop();
    }
  });
}

function draw() {
  background(0, 204, 255);
  image(backimg, imgpos, height/2)
  imgpos -= 0.1
  
  tupp.show();
  tupp.move();
  
  for (let i = 0; i < pillars.length; i++) {
    if (pillars[i].oob()) {
      pillars.splice(i,1)
    }
    pillars[i].show();
    if(pillars[i].x < (width/2+40) && pillars[i].x > (width/2-40)) {
      currentPillar = pillars[i];
      // console.log("current");
    }
  }

  // Uppdaterad kod för hitbox

  if(currentPillar) {
    // change when it centers
    if (tupp.pos.x+25 == currentPillar.x+25) {
      toggleHitbox();
    }
    if ((tupp.pos.x+25) < (currentPillar.x+50)) {
      inside = true;
      // line(0, 0, currentPillar.y, currentPillar.x+50)
      // fill('red')
      // text("Inside" ,width/2, height/2)
      // 0
      // Arbitrary and odd numbers does not work (even translation)
      if (currentPillar.x == 196) {
        score += 1;
        // Toggle back
        toggleHitbox();
      }
    } else {
      inside = false;

    }

  // if(currentPillar) {
  //   if ((tupp.pos.x+25) < (currentPillar.x+50)) {
  //     inside = true;
  //     // fill('red')
  //     // text("Inside" ,width/2, height/2)
  //     // 0
  //     // Arbitrary and odd numbers does not work (even translation)
  //     if (currentPillar.x == 196) {
  //       score += 1;
  //     }
  //   } else {
  //     inside = false;
  //   }

    if(tupp.collided()) {
      endGame();
    } 
  }
  
  if(tupp.oob()) {
    endGame();
  }
  
  textSize(30)
  fill('black')
  text(score, 20, 40)
  if(!start) {
    noLoop();
  }
}

function endGame () {
  try {
    let userElement = select('#user');
    let user = userElement.html();
    let xhr = new XMLHttpRequest();
    let url = "http://localhost:8080/flappytupp3/includes/scores.inc.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
        uid: user,
        score: score
    }));
  } catch (e) {
    
  }

  textSize(30)
  fill('red')
  textAlign(CENTER)
  text('Tuppmördare', width/2, height/2)
  dead.play()
  noLoop();
  button.html('Börja om');
  setTimeout(() => {
    gameOver = true;
  }, 500)
  button.mouseClicked(() => {
    location.reload();
  });
  // fill('red')
  // text("Collided" ,width/2, height/2)
  
  // UPPDATERA POÄNG
  
}

function keyPressed() {
  if (keyCode == 32) {
    if(!start) {
      setInterval(addPillar, 2000); 
      start = true;
      loop();
    }
    if(gameOver) {
      location.reload();
    }
    tupp.flap();
    flap.play();
  }
}

function toggleHitbox() {
  // Toggle the hitbox to check
  hitboxOne = !hitboxOne;
  hitboxTwo = !hitboxTwo;
}

function mouseClicked() {
  if(!start) {
    setInterval(addPillar, 2000);
    start = true;
    loop();
  }
  tupp.flap();
  flap.play();
}