document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('user-form');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const usersContainer = document.getElementById('users-container');

    // Evento de envio do formulário para cadastrar ou atualizar usuário
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        
        const userId = document.getElementById('userId').value;
        const nome = document.getElementById('nome').value;
        const email = document.getElementById('email').value;
        const telefone = document.getElementById('telefone').value;

        // Enviar dados do formulário para o backend usando Fetch API
        const formData = new FormData();
        formData.append('userId', userId);
        formData.append('nome', nome);
        formData.append('email', email);
        formData.append('telefone', telefone);

        fetch('backend.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Exibir mensagem de retorno do servidor
            form.reset(); // Limpar o formulário após o envio bem-sucedido
            fetchUsers(); // Atualizar a lista de usuários após cadastrar/atualizar
            saveBtn.innerText = "Adicionar"; // Restaurar o texto do botão para "Adicionar"
            cancelBtn.style.display = "none"; // Esconder o botão de cancelar
        })
        .catch(error => console.error('Erro:', error));
    });

    // Função para buscar os usuários no banco de dados e renderizar na página
    function fetchUsers() {
        fetch('fetch_users.php')
        .then(response => response.text())
        .then(data => {
            usersContainer.innerHTML = data; // Atualizar o conteúdo da div com os usuários
        })
        .catch(error => console.error('Erro:', error));
    }

    fetchUsers(); // Chamar a função para buscar os usuários ao carregar a página

    // Evento de clique no botão de cancelar
    cancelBtn.addEventListener('click', function() {
        form.reset(); // Limpar o formulário
        saveBtn.innerText = "Adicionar"; // Restaurar o texto do botão para "Adicionar"
        cancelBtn.style.display = "none"; // Esconder o botão de cancelar
    });
});



// Função para excluir um usuário
function deleteUser(userId) {
    if (confirm('Tem certeza que deseja excluir este usuário?')) {
        fetch('backend.php?delete=' + userId)
        .then(response => response.text())
        .then(data => {
            alert(data); // Exibir mensagem de retorno do servidor
            fetchUsers(); // Atualizar a lista de usuários após exclusão
        })
        .catch(error => console.error('Erro:', error));
    }
    function fetchUsers() {
        fetch('fetch_users.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('users-container').innerHTML = data; // Atualizar o conteúdo da div com os usuários
        })
        .catch(error => console.error('Erro:', error));
    }
    
}
