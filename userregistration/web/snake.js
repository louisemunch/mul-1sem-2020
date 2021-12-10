//Her tager vi fat i canavs i html
const canvas = document.getElementById("game");
//Her spørg vi canvas om at få 2d context. Man ville ogsa kunne efterspørge 3d, men det er ikke nødvendigt i dette spil.
    //Så vi starter med at tage fat i canvas, ber den om at hente context og laver en variabel så vi kan bruge den. 
const ctx = canvas.getContext("2d");
//Her bruger vi en class til at tracke længden på snake
class SnakePart {
      //constructor med en x og y position i canva
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }
}
//Her definerer vi en variabel med speed
    //Vi sætter den til 7, så den ikke er så hurtig når vores snake bevæger sig langs skærmen
let speed = 7;
//Meningen er, at vores canva skal forestille at indeholde 20 bokse hen og ned. 
let tileCount = 20;
//Her tager vi 400 / 20 = 20 - 2 = 18.
    //Dette skal være størrelsen på snake
let tileSize = canvas.width / tileCount - 2;
//SNAKE
    //Her definerer vi SNAKE som bliver x positionen for hovedet af Snake. 
    //Den bliver sat til 10, så den er i midten af skærmen
let headX = 10;
  //Og nu har vi defineret Y, som er den lodrette, så nu står i præcis i midten af skærmen
let headY = 10;
//SNAKEPART
//constans Array, for vi skal kun ændre indholdet i den
const snakeParts = [];
//Her sætter vi længden på halen i 2, så når snake bevæger sig, har den automatisk to haler bagved
let tailLength = 2;
//APPLE
let appleX = 5;
let appleY = 5;
//Nu laver vi 2 variabler som sætter hastigheden for snake
//Dem skal vi bruge til vores keyboard listenter
let inputsXVelocity = 0;
let inputsYVelocity = 0;

let xVelocity = 0;
let yVelocity = 0;
//Her har vi en variabel til score value
let score = 0;
//Her opretter vi en Audio objekt med en variabel
//Den ændrer sig ikke, så det er en const variabel
const gulpSound = new Audio("audio/gulp.mp3");

//Her begynder jeg at lave GAME LOOP. 
    //Game loop er dét som konstant opdaterer skærmen. 
    //Man kan gøre dette på 3 måder:
    //requestAnimationFrame
    //setInterval xtimes per a second
    //Denne giver en function som man kan kalde hvert second eller halvt second.
    //setTimeOut
    //Denne bliver kun kaldt 1 gang, men så kan vi kalde den igen. 
    //Denne giver os mulighed for, at ændre hvor tit vi vil opdatere skærmen
function drawGame() {
  xVelocity = inputsXVelocity;
  yVelocity = inputsYVelocity;

  changeSnakePosition();
  //Variabel der indeholder en funktion, som gør at den stopper med at loope og ser den sidste ting der skete i spillet
  let result = isGameOver();
  if (result) {
    return;
  }
  //Her laver vi endnu en funktion som clear screen. 
  clearScreen();

  checkAppleCollision();
  drawApple();
  drawSnake();
  drawScore();
//Her sørger vi for, at hvis score er højere end 5, sætter vi speed op til 9
  if (score > 3) {
    speed = 9;
  }
  if (score > 10) {
    speed = 11;
  }
//Her kalder vi setTimeout og giver den en funktion, som er drawGame selv.
    //Vi sætter den til 1000 milisekunder, som er det samme som 1 sekund. 
    //Derefter dividerer det med vores speed i variablen.
    //Det her gør, at snake bevæger sig 7 gange i sekundet, hvilket gør det nemmere for spilleren i starten
  setTimeout(drawGame, 1000 / speed);
}

//GAME OVER 
function isGameOver() {
  let gameOver = false;
//Hvis yVelocity(hastighed) og xVelocity er = 0, er spillet ikke startet endnu. 
  if (yVelocity === 0 && xVelocity === 0) {
    //Ved at returnere 'false', vil den ikke sige gameover, derfor kan vi starte spillet med det samme
    return false;
  }

//WALLS 
//Hvis jeg rammer X i venstre side
  if (headX < 0) {
    gameOver = true;
    //Hvis snake head er = tileCount(20) på X, så er det gameover og spillet pauses(højre side)
  } else if (headX === tileCount) {
    gameOver = true;
//Det samme med med head på Y aksen. Hvis den er mindre end 0(altså i bunden) så er det gameover. 
  } else if (headY < 0) {
    gameOver = true;
    //Hvis head er det samme som tileCount(20) på y aksen, er det game over
  } else if (headY === tileCount) {
    gameOver = true;
  }

  //SNAKE KROP 
  //Da vi har en snake park bagved head i forvejen, vil den automatisk sige gameover - derfor laves der en if statement øverst i funktionen
  for (let i = 0; i < snakeParts.length; i++) {
    let part = snakeParts[i];
    if (part.x === headX && part.y === headY) {
      gameOver = true;
      break;
    }
  }

  if (gameOver) {
    ctx.fillStyle = "white";
    ctx.font = "50px Verdana";

    if (gameOver) {
      ctx.fillStyle = "white";
      ctx.font = "50px Verdana";

      //Her bruges en metode 'createLinearGradient. Denne laver en lineær gradient. 
      // Parametre (x0,y0,x1,y1)
      var gradient = ctx.createLinearGradient(0, 0, canvas.width, 0);
      //Her bruger vi endnu en metode til at angive farverne og hvor de hver især skal placeres
  
      gradient.addColorStop("0", " magenta");
      gradient.addColorStop("0.5", "blue");
      gradient.addColorStop("1.0", "red");
      // Fill with gradient
      ctx.fillStyle = gradient;

      ctx.fillText("Game Over!", canvas.width / 6.5, canvas.height / 2);
    }

    ctx.fillText("Game Over!", canvas.width / 6.5, canvas.height / 2);
  }

  return gameOver;
}
//Denne funktion bruger ctx til at skrive på skærmen
function drawScore() {
  ctx.fillStyle = "white";
  //Fontsize + fonttype
  ctx.font = "10px Verdana";
  //Bruger fillText til at skrive teksten Score og bruger variablen til at fortælle den specifikke score
  //Derudover skal den have en X og Y position = canvas.width på X - 50, så den ligger i højre hjørne
  //10 er nedad på Y aksen
  ctx.fillText("Score " + score, canvas.width - 50, 10);
}
//CLEAR SCREEN  
function clearScreen() {
  //Her bruger vi variablen ctx, som giver os lov til at tegne i canvas
    //fillStyle er ligesom en malerbørste som i dette tilfælde er sort
  ctx.fillStyle = "#1C2344";
      //Her laver vi et rektangel som starter ved position x 0 og y 0. Hvilket er i øverste venstre hjørne. 
  ctx.fillRect(0, 0, canvas.width, canvas.height);
     //Nu er skærmen sort
}

//DRAW APPLE
    //Her laver vi en funktion som fortæller hvad drawSnake gør. 
    //Den tager context
function drawSnake() {
  ctx.fillStyle = "#BFC9E1";
  //Her laver vi størrelen på snake. 
    // 10 * 20 = 200 og 10 * 20 = 200(Altså midten) og giver den størrelsen 18. 
    //De første to properties er positionen og de sidste to er størrelsen
  for (let i = 0; i < snakeParts.length; i++) {
    let part = snakeParts[i];
    ctx.fillRect(part.x * tileCount, part.y * tileCount, tileSize, tileSize);
  }
//Her sørger vi for, at den tilføjer en ad gangen til dér hvor head var på X og Y aksen
  snakeParts.push(new SnakePart(headX, headY)); //Putter en hale til sidst og ved siden af hovedet
  while (snakeParts.length > tailLength) {
    snakeParts.shift(); // Fjerner den der er længst væk, hvis den har mere end tail.length
  }

  ctx.fillStyle = "#FB3F86";
  ctx.fillRect(headX * tileCount, headY * tileCount, tileSize, tileSize);
}
//CHANGE SNAKE POSITION
    //Denne funktion vil ændre snake headX+Y position
function changeSnakePosition() {
  headX = headX + xVelocity;
  headY = headY + yVelocity;
}
//DRAW APPLE 

    //Her gør vi det samme som med Head
function drawApple() {
  ctx.fillStyle = "#A91F0B";
  ctx.fillRect(appleX * tileCount, appleY * tileCount, tileSize, tileSize);
}

//CHECK APPLE COLLISION
    //Her sørger vi for, at når apple er i fuldstændig samme position som snake, så flyttes apple den til et nyt spot
function checkAppleCollision() {
  if (appleX === headX && appleY == headY) {
    appleX = Math.floor(Math.random() * tileCount);
    appleY = Math.floor(Math.random() * tileCount);
    tailLength++;
    //Her sørger vi for, at hver gang vi rammer Apple, så øges score værdien med 1.
    score++;
    //Her sørger vi for, at hver gang vi rammer Apple, vil den spille lyden
    gulpSound.play();
  }
}


//EVENT LISTENER
    //Her laver vi en eventlistener kaldet 'keydown' og tilføjer en funktion kaldet keyDown. 
    //
document.body.addEventListener("keydown", keyDown);
    //Her definerer vi funktionen 'keyDown'
    //Denne funktionvil lede efter alle key presses og bruge et event
function keyDown(event) {
      //Her kan vi bestemme hvilken tast der skal bruges. 
    //Her bruger man keyCode, da alle taster har en kode. Google det
//Key UP!
  if (event.keyCode == 38 || event.keyCode == 87) {
       //Her sørger vi for, at vi ikke kan pege op og ned efter hinanden. Så rammer snake sin egen krop.
    if (inputsYVelocity == 1) return;
        //Når man klikker på UP, ændres Snake til at gå i minus på Y aksen dvs. opad 
    //Samt X aksen vil være 0, da den ikke bevæger sig vandret
    inputsYVelocity = -1;
    inputsXVelocity = 0;
  }

//Key DOWN!
  if (event.keyCode == 40 || event.keyCode == 83) {
    if (inputsYVelocity == -1) return;
 //Denne er nu positiv, da den går nedad y aksen
    inputsYVelocity = 1;
      //Forbliver stadivæk 0, da vi kun bevæger os på Y aksen
    inputsXVelocity = 0;
  }

//Key LEFT!
  if (event.keyCode == 37 || event.keyCode == 65) {

    if (inputsXVelocity == 1) return;
    inputsYVelocity = 0;
    inputsXVelocity = -1;
  }

//Key RIGHT!
  if (event.keyCode == 39 || event.keyCode == 68) {

    if (inputsXVelocity == -1) return;
    inputsYVelocity = 0;
    inputsXVelocity = 1;
  }
}

drawGame();
