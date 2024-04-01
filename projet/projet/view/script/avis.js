let dateSysteme = new Date();

const formattedDate = dateSysteme.toLocaleDateString('fr-FR', { year: 'numeric', month: '2-digit', day: '2-digit' });
document.getElementById("date_avis").textContent = formattedDate;
document.getElementById('date_avis').value  = formattedDate;

const value = document.querySelector("#value");
const note = document.querySelector("#pi_input");
value.textContent = note.value;
note.addEventListener("input", (event) => {
  value.textContent = event.target.value;
});