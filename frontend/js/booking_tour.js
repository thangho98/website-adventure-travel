



///////////////////////////////////////////////
function Main() {
    new SearchForm().Init();
    new BooingTour().Init();
    new TourDetails().CreateStarsAllPage();
}

document.addEventListener('loadend', Main());

