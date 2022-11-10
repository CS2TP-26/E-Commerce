const form = document.getElementById('form');
const firstName = document.getElementById('firstName');
const query = document.getElementById('query');
const email = document.getElementById('email');
var error = document.getElementById('error');
// these varibles above get all the data from the input boxes so we can manipulate them.




// for hiding and showing errors
let hideme = document.querySelector('.hideme');
let contactMe = document.querySelector('.contactMe');







form.addEventListener('submit', (e) => { // when the form submit button is clicked
    e.preventDefault();

    hideme.style.display = 'flex';
    contactMe.style.display = 'none';


    const txtFName = firstName.value.trim();
    const txtEmail = email.value.trim(); // new text varibles that will be used to display the text to h2's
    const txtQuery = query.value.trim();


    document.getElementById('1').innerHTML = "Name: " + txtFName;
    document.getElementById('2').innerHTML = "Email: " + txtEmail;
    document.getElementById('3').innerHTML = "Query: " + txtQuery;
});

// let btn = document.getElementById('button'); // connects the new button to the script


// btn.addEventListener('click', () => {
//     document.getElementById('4').innerHTML = "Query Sent!";
// });