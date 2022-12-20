import './bootstrap';
// Import our custom CSS
import '../sass/app.scss'

 // Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap'
window.addEventListener('load', function(){

    let buyoutButton = document.getElementById('buyout-button');
    if(buyoutButton){
        buyoutButton.addEventListener('click', function (){
            let bidform = document.getElementById('bid-form');
            let priceInput = bidform.querySelector('.price-input');
            priceInput.value = buyoutButton.dataset.buyoutPrice;
            bidform.submit();
        });
    }







    // Set the date we're counting down to
     let timers = document.querySelectorAll('.timer');

     timers.forEach(function (timer){

         let timeField = timer.querySelector(".time-value");
         let countDownDate = new Date(timeField.dataset.time).getTime();

// Update the count down every 1 second
         let x = setInterval(function() {

             // Get today's date and time
             let now = new Date().getTime();

             // Find the distance between now and the count down date
             let distance = countDownDate - now;

             // Time calculations for days, hours, minutes and seconds
             let days = Math.floor(distance / (1000 * 60 * 60 * 24));
             let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
             let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
             let seconds = Math.floor((distance % (1000 * 60)) / 1000);

             // Display the result in the element with id="demo"
             timeField.innerHTML = days + "d " + hours + "h "
                 + minutes + "m " + seconds + "s ";

             // If the count down is finished, write some text
             if (distance < 0) {
                 clearInterval(x);
                 timeField.innerHTML = "EXPIRED";
             }
         }, 1000);

     });




});
