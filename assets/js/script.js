document.addEventListener('DOMContentLoaded', function() {
    console.log('JS carregado com sucesso!');
    
    const loginForm = document.getElementById('formLogin');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            console.log('Evento submit disparado');
            
            const usuario = document.querySelector('input[name="usuario"]');
            const senha = document.querySelector('input[name="senha"]');
            
            let erro = false;
            let mensagem = '';
            
            if (usuario.value.trim().length < 4) {
                mensagem += '❌ Usuário deve ter no mínimo 4 caracteres.\n';
                usuario.style.border = '2px solid red';
                erro = true;
            } else {
                usuario.style.border = '';
            }
            
            if (senha.value.trim().length < 6) {
                mensagem += '❌ Senha deve ter no mínimo 6 caracteres.\n';
                senha.style.border = '2px solid red';
                erro = true;
            } else {
                senha.style.border = '';
            }
            
            if (erro) {
                event.preventDefault();
                alert(mensagem);
            }
        });
    } else {
        console.log('Formulário de login não encontrado!');
    }
});