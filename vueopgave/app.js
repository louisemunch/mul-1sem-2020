
//OPGAVE 1 - DRUMKIT PLAY OVERSKRIFT OG NAVN
Vue.createApp({
    data() {
      return {
        message: ''
      }
    }
  }).mount('#v-model-basic')

//DRUMKIT - SOUNDS Dog uden VUEjs
document.addEventListener("keypress" , function(event) {

    makeSound(event.key);
        })
function makeSound(key){
    switch (key) {
        case "w":
            var crash = new Audio("sounds/crash.mp3")
            crash.play();
            break;
            case "a":
             var kickBass = new Audio("sounds/kick-bass.mp3")
             kickBass.play();
             break;
             case "s":
                 var snare = new Audio("sounds/snare.mp3")
                 snare.play();
                 break;
                 case "d":
                     var tom1 = new Audio("sounds/tom-1.mp3")
                     tom1.play();
                     break;
                     case "j":
                         var tom2 = new Audio("sounds/tom-2.mp3")
                         tom2.play();
                         break;
                         case "k":
                             var tom3 = new Audio("sounds/tom-3.mp3")
                             tom3.play();
                             break;
                             case "l":
                                 var tom4 = new Audio("sounds/tom-4.mp3")
                                 tom4.play();
                                 break;
                                 
        default:
            break;
    }
    }




//OPGAVE 2 - INPUT VALIDATION
const formcomponent = {
    data(){
        return {
name: null,
email : null , 
password : null , 
repeatPassword : null ,
number : null , 
adress : null , 
zipNumber : null , 
errors : []
        }
    } , 
    methods : {
chechform() {
    if(this.name && this.email && this.password && this.repeatPassword && this.number && this.adress && this.zipNumber) {
        return true
      
    }
    this.errors = []
    if(!this.name) {
        this.errors.push("Name required")
    }
    if(!this.email) {
        this.errors.push("Email required")
    }
    if(!this.password) {
        this.errors.push("Password required")
    }
    if(!this.repeatPassword) {
        this.errors.push("Repeat Password required")
    }
    if(!this.number) {
        this.errors.push("Number required")
    }
    if(!this.adress) {
        this.errors.push("Adress required")
    }
    if(!this.zipNumber) {
        this.errors.push("Zip number required")
    }
}
    }

}
const myform = vue.createApp(formcomponent).mount('#myform')