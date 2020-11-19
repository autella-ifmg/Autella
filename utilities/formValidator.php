<?php
echo "
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (checarSenhas() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    // Bootstrap verification
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    
                    form.classList.add('was-validated');
                }   
            }, false);
        });
    }, false);
})();



// Verify if inputPassword and inputConfirmPassword match
function checarSenhas() {
    let p1 = document.querySelector('#password');
    let p2 = document.querySelector('#confirmPassword');

    if(p1.value == p2.value){
        return true;
    } else {
        p1.classList.add('is-invalid');
        p2.classList.add('is-invalid');
        return false;
    }
}
</script>
";
