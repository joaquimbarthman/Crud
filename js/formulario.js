function senha_visivel(campo_id, icone_id) {
    const senha = document.getElementById(campo_id);
    const olho = document.getElementById(icone_id);
    
    if (senha.type === 'password') {
        senha.type = 'text';
        olho.src = '../icon/ver.svg';
    } else {
        senha.type = 'password';
        olho.src = '../icon/ocultar.svg';
    }
    
}


function mostrar() {
    let popups = document.querySelectorAll(".popup");
    popups.forEach(popup => {
        popup.classList.add("show");

        setTimeout(() => {
            fechar(popup.querySelector("button"));
        }, 6500);
    });
}

function fechar(botao) {
    let popup = botao.closest(".popup"); 
    if (popup) {
        popup.classList.remove("show");

        setTimeout(() => {
            let id = popup.id;
            if (id === "erro") {
                window.history.back(); 
            } else {
                window.location.href = "../index.php"; 
            }
        }, 1000);
    }
}

setTimeout(mostrar, 50);
