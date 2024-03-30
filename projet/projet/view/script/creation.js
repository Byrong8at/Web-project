function restart(){
    let inputrestet=document.querySelectorAll('input[type=text],textarea, input[type=password]');
    inputrestet.forEach(function(input) {
        input.value="";
    }
    )
}

date=document.querySelector('input[name="date"]').valueAsDate = new Date();

const formattedDate = date.toLocaleDateString('fr-FR', {  year: 'numeric', month: '2-digit',day: '2-digit' });


document.querySelector("#description").addEventListener("input", (event) => {
    let vlr = event.target.value.replace(/[^a-zA-Z0-9]/g, ''); 
    event.target.value = vlr;
    if (vlr.length > 256){
        event.target.value = vlr.slice(0, 256);
    }
});
