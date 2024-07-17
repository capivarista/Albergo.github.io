
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
      var messageElement = document.createElement("div");
      messageElement.textContent = message;
      chatContent.appendChild(messageElement);
      input.value = "";
      chatContent.scrollTop = chatContent.scrollHeight;
    }
  }

