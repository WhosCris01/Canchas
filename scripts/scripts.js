
function logear() {
    var user = document.getElementsByName('userBox')[0].value;
    var password = document.getElementsByName('passwordBox')[0].value;

    
    if (user === 'usuario' && password === 'contraseña') {
        
        window.location.href = "menuArriendo.php";
        return false;
    } else {
        alert('Usuario o contraseña incorrectos.');
        return false;
    }
}