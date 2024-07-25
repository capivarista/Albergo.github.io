function openChat() {
  document.getElementById("chatModal").style.display = "block";
}

function closeChat() {
  document.getElementById("chatModal").style.display = "none";
}

function sendMessage() {
  var input = document.getElementById("chatInput");
  var message = input.value;
  if (message.trim() !== "") {
    var chatContent = document.getElementById("chatContent");

    //Adiciona a mensagem do usuário
    var userMessageElement = document.createElement("div");
    userMessageElement.textContent = "Você: " + message;
    chatContent.appendChild(userMessageElement);

    //Gera a resposta 
    var botMessageElement = document.createElement("div");
    botMessageElement.textContent = "Albergo: Em desenvolvimento!";
    chatContent.appendChild(botMessageElement);

    input.value = "";
    chatContent.scrollTop = chatContent.scrollHeight;
  }
}

function toggleSubMenu() {
  var submenu = document.getElementById("submenu");
  if (submenu.style.display === "block") {
    submenu.style.display = "none";
  } else {
    submenu.style.display = "block";
  }
}

document.addEventListener('DOMContentLoaded', function() {
    const loginLink = document.getElementById('login-link');

    // Verifica se o usuário está logado (você pode verificar o cookie ou qualquer outro indicador de login)
    const isLoggedIn = document.cookie.split('; ').find(row => row.startsWith('loggedIn='));

    if (isLoggedIn) {
        loginLink.textContent = 'PERFIL';
        loginLink.href = 'perfil.html'; // Altere para a página de perfil
    }
});

