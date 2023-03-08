
var selectField = document.getElementById("selectField");
var selectText = document.getElementById("selectText");
var options = document.getElementsByClassName("options");
var list = document.getElementById("list");
var arrowIcon = document.getElementById("arrowIcon");

selectField.onclick = function(){
list.classList.toggle("hide");
arrowIcon.classList.toggle("rotate");
}

for (option of options){
    option.onclick = function(){
        selectText.innerHTML = this.textContent;
        list.classList.toggle("hide");
        arrowIcon.classList.toggle("rotate");
    }
}



var selectField2 = document.getElementById("selectField2");
var selectText2 = document.getElementById("selectText2");
var options2 = document.getElementsByClassName("options2");
var list2 = document.getElementById("list2");
var arrowIcon2 = document.getElementById("arrowIcon2");

selectField2.onclick = function(){
list2.classList.toggle("hide");
arrowIcon2.classList.toggle("rotate");
}

for (option of options2){
    option.onclick = function(){
        selectText2.innerHTML = this.textContent;
        list2.classList.toggle("hide");
        arrowIcon2.classList.toggle("rotate");
    }
}



var selectField3 = document.getElementById("selectField3");
var selectText3 = document.getElementById("selectText3");
var options3 = document.getElementsByClassName("options3");
var list3 = document.getElementById("list3");
var arrowIcon3 = document.getElementById("arrowIcon3");

selectField3.onclick = function(){
list3.classList.toggle("hide");
arrowIcon3.classList.toggle("rotate");
}

for (option of options3){
    option.onclick = function(){
        selectText3.innerHTML = this.textContent;
        list3.classList.toggle("hide");
        arrowIcon3.classList.toggle("rotate");
    }
}



var selectField4 = document.getElementById("selectField4");
var selectText4 = document.getElementById("selectText4");
var options4 = document.getElementsByClassName("options4");
var list4 = document.getElementById("list4");
var arrowIcon4 = document.getElementById("arrowIcon4");

selectField4.onclick = function(){
list4.classList.toggle("hide");
arrowIcon4.classList.toggle("rotate");
}

for (option of options4){
    option.onclick = function(){
        selectText4.innerHTML = this.textContent;
        list4.classList.toggle("hide");
        arrowIcon4.classList.toggle("rotate");
    }
}



var selectField5 = document.getElementById("selectField5");
var selectText5 = document.getElementById("selectText5");
var options5 = document.getElementsByClassName("options5");
var list5 = document.getElementById("list5");
var arrowIcon5 = document.getElementById("arrowIcon5");

selectField5.onclick = function(){
list5.classList.toggle("hide");
arrowIcon5.classList.toggle("rotate");
}

for (option of options5){
    option.onclick = function(){
        selectText5.innerHTML = this.textContent;
        list5.classList.toggle("hide");
        arrowIcon5.classList.toggle("rotate");
    }
}



var selectField6= document.getElementById("selectField6");
var selectText6 = document.getElementById("selectText6");
var options6 = document.getElementsByClassName("options6");
var list6 = document.getElementById("list6");
var arrowIcon6 = document.getElementById("arrowIcon6");

selectField6.onclick = function(){
list6.classList.toggle("hide");
arrowIcon6.classList.toggle("rotate");
}

for (option of options6){
    option.onclick = function(){
        selectText6.innerHTML = this.textContent;
        list6.classList.toggle("hide");
        arrowIcon6.classList.toggle("rotate");
    }
}



var selectField30 = document.getElementById("selectField30");
var selectText30 = document.getElementById("selectText30");
var options30 = document.getElementsByClassName("options30");
var list30 = document.getElementById("list30");
var arrowIcon30 = document.getElementById("arrowIcon30");

selectField30.onclick = function(){
list30.classList.toggle("hide");
arrowIcon30.classList.toggle("rotate");
}

for (option of options30){
    option.onclick = function(){
        selectText30.innerHTML = this.textContent;
        list30.classList.toggle("hide");
        arrowIcon30.classList.toggle("rotate");
    }
}

var selectField32 = document.getElementById("selectField32");
var selectText32 = document.getElementById("selectText32");
var options32 = document.getElementsByClassName("options32");
var list32 = document.getElementById("list32");
var arrowIcon32 = document.getElementById("arrowIcon32");

selectField32.onclick = function(){
list32.classList.toggle("hide");
arrowIcon32.classList.toggle("rotate");
}

for (option of options32){
    option.onclick = function(){
        selectText32.innerHTML = this.textContent;
        list32.classList.toggle("hide");
        arrowIcon32.classList.toggle("rotate");
    }
}

$(function() {

  // rome(inline_cal, { time: false });


	rome(inline_cal, {time: false, inputFormat: 'MMMM DD, YYYY'}).on('data', function (value) {
	  result.value = value;
	  
	});

});



