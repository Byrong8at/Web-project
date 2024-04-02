function restart(){
    let inputrestet=document.querySelectorAll('input[type=text],textarea, input[type=password]');
    inputrestet.forEach(function(input) {
        input.value="";
    }
    )
}

