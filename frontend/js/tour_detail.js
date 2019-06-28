



///////////////////////////////////////////////
function Main() {
    new SearchForm().Init();
    new User().Init();
    new TourDetails().Init();
}

document.addEventListener('loadend', Main());

