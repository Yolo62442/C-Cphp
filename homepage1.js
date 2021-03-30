
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
function Contact(){
    alert('You can call 8-778-37-97-221 or send me private messsage z.zhailanova@astanait.edu.kz')
}
function Send(){
    alert('Your message succesfully send!')
}
function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Read more"; 
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "Read less"; 
      moreText.style.display = "inline";
    }
  }
  function myFunction2() {
    var dots = document.getElementById("dots2");
    var moreText = document.getElementById("more2");
    var btnText = document.getElementById("myBtn2");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Read more"; 
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "Read less"; 
      moreText.style.display = "inline";
    }
  }
  function myFunction3() {
    var dots = document.getElementById("dots3");
    var moreText = document.getElementById("more3");
    var btnText = document.getElementById("myBtn3");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Read more"; 
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "Read less"; 
      moreText.style.display = "inline";
    }
  }
  function set(n){
    var i;
    if(n == 6)
    document.getElementById(6).style.color = "red";
    else{
      for(i = 1; i <= n; i++){
          document.getElementById(i).style.color = "orange";
      }
      for(i = n+1; i <= 5; i++){
        document.getElementById(i).style.color = "black";
    }
    }
  }
function tempr(selectedType)
{
  let cel = document.querySelector("#Celsius").value;
  var result = 0;
  if(selectedType === "Fahrenheit")
  {
    result = cel*9/5 +32;
  }
  if(selectedType === "Kelvin")
  {
    result = cel*1 + 273;
  }
  document.querySelector("#result").value = result;
}
function tempr2(selectedType)
{
  let cel = document.querySelector("#Fahrenheit").value;
  var result = 0;
  if(selectedType === "Celsius")
  {
    result = (cel*1 - 32)*5/9;
  }
  if(selectedType === "Kelvin")
  {
    result = (cel*1 - 32)*5/9 + 273;
  }
  document.querySelector("#result2").value = result;
}
function tempr3(selectedType)
{
  let cel = document.querySelector("#Kelvin").value;
  var result = 0;
  if(selectedType === "Celsius")
  {
    result = (cel*1 - 273);
  }
  if(selectedType === "Fahrenheit")
  {
    result = (cel*1 - 273)*9/5 +32;
  }
  document.querySelector("#result3").value = result;
}


function myMap() {
    var pos = new google.maps.LatLng(51.161213, 71.450543);
    var mapProp= {
      center:pos,
      zoom:10,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    var marker = new google.maps.Marker({position: new google.maps.LatLng(51.090984, 71.418323) });

marker.setMap(map);
}


function KoreanCuisine() {
    var pos = new google.maps.LatLng(51.133526, 71.420546);
    var mapProp= {
      center:pos,
      zoom:15,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    var marker = new google.maps.Marker({position: pos });
    marker.setMap(map);
    
}
//This code should change the recipe of the day by using current time but i can not find the reason why it does not work
function ROD(){
  var m = new Date().getDay();
  var n = 0;
  n = ((m) % 6);
  if ( n == 0 ){
    document.getElementById("ROD").href = "file:///C:/Users/Zhansaya/Desktop/project/Recipe-6.html"
  } else if ( n == 1){
    document.getElementById("ROD").href = "file:///C:/Users/Zhansaya/Desktop/project/Recipe-1.html"
  } else if ( n == 2){
    document.getElementById("ROD").href = "file:///C:/Users/Zhansaya/Desktop/project/Resipe-2.html"
  } else if ( n == 3){
    document.getElementById("ROD").href = "file:///C:/Users/Zhansaya/Desktop/project/Resipe-3.html"
  } else if ( n == 4){
    document.getElementById("ROD").href = "file:///C:/Users/Zhansaya/Desktop/project/Recipe-4.html"
  } else{
    document.getElementById("ROD").href = "file:///C:/Users/Zhansaya/Desktop/project/Resipe-5.html"
  }
}

