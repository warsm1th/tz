function validation(form){

    function removeError(input){
        const parent = input.parentNode;
        if (parent.classList.contains('error')){
            parent.querySelector('.error-label').remove();
            parent.classList.remove('error');
        }
    }

    function createError(input, text){
        const parent = input.parentNode;
        const errorLabel = document.createElement('label');
        errorLabel.classList.add('error-label');
        errorLabel.textContent = text;
        parent.append(errorLabel)
        parent.classList.add('error');
    }

    let result = true;

    const allInputs = document.querySelectorAll('input');

    for (input of allInputs){
        removeError(input);
        if(input === document.getElementById('phone')){
            let value = Number(input.value.replace(/[^\d]/g, ''));
            if (value == ""){
                createError(input, 'Укажите номер телефона!');
                result = false;
            }
            else if (String(value).length < 11){
                createError(input, 'Телефон должен включать не менее 11-ти цифр!');
                result = false;
            }
        }

        if(input === document.getElementById('email')){
            let value = input.value.toLowerCase();
            const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
            if (value == ""){
                createError(input, 'Укажите Email!');
                result = false;
            }
            else if(!EMAIL_REGEXP.test(value)){
                createError(input, 'Некорректный Email!');
                result = false;
            }
        }

        if(input === document.getElementById('name')){
            let value = input.value;
            if (value == ""){
                createError(input, 'Укажите имя!');
                result = false;
            }
            else if(value.length < 2){
                createError(input, 'Имя должно включать не менее 2-х символов!');
                result = false;
            }
        }

    }

    return result;

}

document.getElementById('add-form').addEventListener('submit', function(event){
    event.preventDefault();
    if (validation(this) == true){
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "http://localhost/tz/index.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        let data = `name=${document.getElementById('name').value}
        &email=${document.getElementById('email').value.toLowerCase()}
        &phone=${Number(document.getElementById('phone').value.replace(/[^\d]/g, ''))}`;

        xhr.send(data);

        xhr.onreadystatechange = function ()
        {
            if (this.readyState === 4 && this.status === 200)
            {
                console.log(this.responseText)
                document.getElementById("info").innerHTML = this.responseText;
            }
        }
    }
})