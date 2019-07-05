



///////////////////////////////////////////////
function Main() {
    new SearchForm().Init();
    new BooingTour().Init();
    new TourDetails().CreateStarsAllPage();
    new User().Init();
}

document.addEventListener('loadend', Main());

