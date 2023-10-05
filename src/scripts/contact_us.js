function getURLParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

window.addEventListener('DOMContentLoaded', function () {
    var role = getURLParameter('role');

    if (role == 'patient') {
        var Fname = getURLParameter('first_name');
        var Lname = getURLParameter('last_name');
        var email = getURLParameter('email');

        document.querySelector('input[name="Fname"]').value = Fname;
        document.querySelector('input[name="Lname"]').value = Lname;
        document.querySelector('input[name="email"]').value = email;
    }
    else if (role == 'doctor') {
        var Fname = getURLParameter('first_name');
        var Lname = getURLParameter('last_name');
        var email = getURLParameter('email');
        var Hname = getURLParameter('company_name');

        document.querySelector('input[name="Fname"]').value = Fname;
        document.querySelector('input[name="Lname"]').value = Lname;
        document.querySelector('input[name="email"]').value = email;
        document.querySelector('input[name="Hname"]').value = Hname;
    }
    else if (role == 'insurance_agent') {
        var Fname = getURLParameter('first_name');
        var Lname = getURLParameter('last_name');
        var email = getURLParameter('email');
        var Cname = getURLParameter('company_name');

        document.querySelector('input[name="Fname"]').value = Fname;
        document.querySelector('input[name="Lname"]').value = Lname;
        document.querySelector('input[name="email"]').value = email;
        document.querySelector('input[name="Cname"]').value = Cname;
    }
    else if (role == 'healthcare_provider') {
        var companyName = getURLParameter('company_name');
        var email = getURLParameter('email');
        document.querySelector('input[name="company_name"]').value = companyName;
        document.querySelector('input[name="email"]').value = email;
    }
    else if (role == 'broker') {
        var Fname = getURLParameter('first_name');
        var Lname = getURLParameter('last_name');
        var email = getURLParameter('email');

        document.querySelector('input[name="Fname"]').value = Fname;
        document.querySelector('input[name="Lname"]').value = Lname;
        document.querySelector('input[name="email"]').value = email;
    }
});


