function restart(){
    let inputrestet=document.querySelectorAll('input[type=text], input[type=password]');
    inputrestet.forEach(function(input) {
        input.value="";
    }
    )
}


