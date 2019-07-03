



///////////////////////////////////////////////
function Main() {
    new SearchForm().Init();
    new User().Init();
    new TourDetails().CreateStarsAllPage();
}

document.addEventListener('loadend', Main());

