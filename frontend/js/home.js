class Effects {
    static fadeIn(element) {
        let interval = setInterval(fade, 20);
        let op = 0;
        function fade() {
            if (op >= 1) {
                clearInterval(interval);
            }
            op += 0.05;
            element.style.opacity = op;
        }
    }

    static fadeOut(element) {
        let interval = setInterval(fade, 20);
        let op = element.style.opacity;
        function fade() {
            if (op <= 0) {
                clearInterval(interval);
                element.style.display = "none";
                element.style.opacity = 1;
            }
            op -= 0.05;
            element.style.opacity = op;
        }
    }
}

///////////////////////////////////////////////
class SearchForm {
    constructor() {
        this.btnSearchs = document.getElementsByClassName("search-item");
        this.formSearchs = document.getElementsByClassName("search-form");
        this.backgroundBlur = document.getElementById("background-blur");
        this.searchWrapper = document.getElementById("search");

        this.AddEvents(this.btnSearchs, this.formSearchs, this.backgroundBlur, this.searchWrapper);
    }

    AddEvents(btnSearchs, formSearchs, backgroundBlur, searchWrapper) {

        AddEventsBtnSearch();
        AddEventBackgroundBlur();

        function AddEventsBtnSearch() {
            for (let i = 0; i < btnSearchs.length; i++) {
                btnSearchs[i].addEventListener('click', function () { BtnSearchClick(formSearchs[i]) });
            }

            function BtnSearchClick(form) {
                ShowFormSearch(form);
            }

        }

        function AddEventBackgroundBlur() {
            backgroundBlur.addEventListener('click', function () {
                for (let i = 0; i < formSearchs.length; i++) {
                    HideFormSearch(formSearchs[i]);
                }
            });
        }

        function ShowFormSearch(form) {
            for (let i = 0; i < formSearchs.length; i++) {
                formSearchs[i].style.display = "none";
            }

            form.style.display = "block";
            Effects.fadeIn(form);
            backgroundBlur.style.display = "block";
            backgroundBlur.style.opacity = 0.8;
            searchWrapper.style.zIndex = 9999;
        }

        function HideFormSearch(form) {
            Effects.fadeOut(backgroundBlur);
            form.style.display = "none";
            form.style.opacity = 0;
            searchWrapper.style.zIndex = 1;
        }
    }


}

class User {
    constructor() {
        this.btnUsers = document.getElementsByClassName("user-item");
        this.userForms = document.getElementsByClassName("user-form");
        this.backgroundBlur = document.getElementById("background-blur");
        this.btnCloses = document.getElementsByClassName("btn-close");
        this.AddEvents(this.btnUsers, this.userForms, this.backgroundBlur, this.btnCloses);
    }

    AddEvents(btnUsers, userForms, backgroundBlur, btnCloses) {

        AddEventBtnSignIn();
        AddEventBackgroundBlur();
        AddEventBtnClose();


        function AddEventBtnSignIn() {
            for (let i = 0; i < btnUsers.length; i++) {
                btnUsers[i].addEventListener('click', function () { BtnSignInClick(userForms[i]); });
            }

            function BtnSignInClick(form) {
                ShowSignInForm(form);
            }
        }

        function AddEventBackgroundBlur() {
            backgroundBlur.addEventListener('click', function () {
                for (let i = 0; i < userForms.length; i++) {
                    HideFormUser(userForms[i]);
                }
            });
        }

        function AddEventBtnClose() {
            for (let i = 0; i < btnCloses.length; i++) {
                btnCloses[i].addEventListener('click', function () {
                    HideFormUser(userForms[i]);
                });
            }
        }

            function ShowSignInForm(form) {
                form.style.display = "block";
                form.style.zIndex = 9999;
                Effects.fadeIn(form);
                backgroundBlur.style.display = "block";
                backgroundBlur.style.opacity = 0.8;
            }

            function HideFormUser(form) {
                Effects.fadeOut(backgroundBlur);
                form.style.display = "none";
                form.style.opacity = 0;
                form.style.zIndex = 1;
            }
        }
    }




///////////////////////////////////////////////
function Main() {
    new SearchForm();
    new User();
}

document.addEventListener('loadend', Main());

