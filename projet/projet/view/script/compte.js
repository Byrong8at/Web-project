let burger = document.querySelector("#hamburger");
let menu = document.getElementById("menu");

document.getElementById("hamburger").addEventListener("click", function() {

    burger.classList.toggle("hidden");

    if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
    } else {
        menu.classList.remove("hidden");
        show();
    }
});

document.getElementById("croix").addEventListener("click", function() {
    

    burger.classList.toggle("hidden");

    if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
        show();
    } else {
        menu.classList.remove("hidden");
    }
});

let CV = document.getElementById("cv");
let candidature = document.getElementById("candidatures");
let calendrier = document.getElementById("Calendrier");
let favori = document.getElementById("favori");
let modele = document.getElementById("modele");
let events = document.getElementById("Evenement");

let elements = [
    CV,candidature,calendrier,favori,modele,events
];

let Cv_see=document.getElementById('cv_affichage');
let candi_see=document.getElementById('candidatures_affichage');
let cal_see=document.getElementById('calendrier_affichage');
let fav_see=document.getElementById('Favori_affichage');
let mod_see=document.getElementById('modele_affichage');
let event_see=document.getElementById('event_affichage');

let looker =[
    Cv_see,candi_see,cal_see,fav_see,mod_see,event_see
];

function show(currentElement, seem) {
    elements.forEach((element, index) => {
        element.className = element === currentElement ? "bg-blue-700 bg-opacity-50 rounded-md px-10" : "";
        if (element === currentElement) {
            seem[index].classList.remove("hidden"); 
        } else {
            seem[index].classList.add("hidden"); 
        }
    });
}



elements.forEach(element => {
    element.addEventListener('click', () => {
        show(element,looker)
    });
});


const monthNames = [
    "Janvier", "Février", "Mars",
    "Avril", "Mai", "Juin", "Juillet",
    "Août", "Septembre", "Octobre",
    "Novembre", "Décembre"
  ];
  
  const daysOfWeek = ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"];
  
  function generateCalendar(year, month) {
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDay = firstDay.getDay();
  
    const calendar = document.getElementById("calendar");
    calendar.innerHTML = '';
  
    // Display the current month
    const currentMonthElement = document.getElementById("currentMonth");
    currentMonthElement.textContent = `${monthNames[month]} ${year}`;
  
    // Create headers for days of the week
    for (let day of daysOfWeek) {
      const dayElement = document.createElement("div");
      dayElement.textContent = day;
      dayElement.classList.add("text-center", "bg-gray-100", "p-2", "rounded-md", "font-medium");
      calendar.appendChild(dayElement);
    }
  
    // Add empty boxes for days before the first day of the month
    for (let i = 0; i < startingDay; i++) {
      const dayElement = document.createElement("div");
      dayElement.classList.add("text-center", "bg-gray-100", "p-2", "rounded-md");
      calendar.appendChild(dayElement);
    }
  
    // Add numbered boxes for each day in the month
    for (let i = 1; i <= daysInMonth; i++) {
      const dayElement = document.createElement("div");
      dayElement.textContent = i;
      dayElement.classList.add("text-center", "bg-white", "p-2", "rounded-md");
      calendar.appendChild(dayElement);
    }
  }
  
  
  
