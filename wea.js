function login() {
    axios.post(`api/index.php/login/${document.forms[0].user.value}`, {
            user: document.forms[0].user.value,
            pass: document.forms[0].pass.value,
        })
        .then(resp => {
            console.log(response);
        })
        .catch(error => {
            console.log(error);
        });
}