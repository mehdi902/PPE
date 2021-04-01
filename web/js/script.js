$(document).ready(function() {

var listeD = document.getElementById("listeD");
var listeV = document.getElementById("listeV");

var numDepartement = "";




 function departement(){

 var request= $.ajax({
 url: "https://geo.api.gouv.fr/departements?fields=codeRegion", method:
"GET",
 dataType: "json",
 beforeSend: function( xhr ) {
 xhr.overrideMimeType( "application/json; charset=utf-8" );
 }});
 request.done(function( msg ) {

 $.each(msg, function(index,e){

 var li = document.createElement('option');
 li.innerHTML = e.code +" / "+ e.nom;
 li.value = e.code;


 listeD.appendChild(li);


 });
 });
 // Fonction qui se lance lorsque l’accès au web service provoque une erreur
 request.fail(function( jqXHR, textStatus ) {
 alert ('erreur');
 });
 }
 

function ville(){
listeV.innerHTML = '';
 var request= $.ajax({
 url: "https://geo.api.gouv.fr/departements/"+numDepartement+"/communes?fields=nom,code,codesPostaux,codeDepartement,codeRegion,population&format=json&geometry=centre", method:
"GET",
 dataType: "json",
 beforeSend: function( xhr ) {
 xhr.overrideMimeType( "application/json; charset=utf-8" );
 }});
 request.done(function( msg ) {

 $.each(msg, function(index,e){

 var li = document.createElement('option');
 li.innerHTML = e.nom;
 li.value = e.nom;

 listeV.appendChild(li);


 });
});
 // Fonction qui se lance lorsque l’accès au web service provoque une erreur
 request.fail(function( jqXHR, textStatus ) {
 alert ('erreur');
 });
 }


listeD.addEventListener('mouseup', e => {

numDepartement = listeD.options[listeD.selectedIndex].value;
console.log(listeD.options[listeD.selectedIndex].value);

ville();

});
listeV.addEventListener('mouseup', e => {



});

// Appel de la fonction ajax

departement();
 


});
