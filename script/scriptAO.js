$(document).ready(function () {

    var current_fs, next_fs, previous_fs;
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function () {

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        // Vérification des champs requis dans l'étape actuelle
        if (!validateCurrentStep(current_fs)) {
            return false;
        }

        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        next_fs.show();

        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(++current);
    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        previous_fs.show();

        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar").css("width", percent + "%");
    }

    function validateCurrentStep(current_fs) {
        var isValid = true;

        // Vérifier les champs requis dans l'étape actuelle
        current_fs.find('input[required], textarea[required], select[required]').each(function () {
            if ($(this).val() === '') {
                isValid = false;
                // Afficher un message d'erreur ou prendre une autre action appropriée
                // lorsque le champ requis est vide
            }
        });

        return isValid;
    }

    $(".action-button").click(function () {
        
    });

});