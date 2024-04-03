if(navigator.serviceWorker){
    navigator.serviceWorker.register('sw.js').catch(err => console.error);
}