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
