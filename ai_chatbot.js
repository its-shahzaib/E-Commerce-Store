function sendMessage(event) {
    if (event.key === "Enter") {
        let input = document.getElementById("userInput").value.toLowerCase().trim();
        let chat = document.getElementById("chat-area");

        chat.innerHTML += `<p><b>You:</b> ${input}</p>`;

        let reply = getAIResponse(input);

        chat.innerHTML += `<p><b>AI:</b> ${reply}</p>`;
        document.getElementById("userInput").value = "";
    }
}

function getAIResponse(input) {
    if (input.match(/hi|hello|hey|salam|assalam/)) {
        return "Hello! 😊 How can I assist you today?";
    }

    if (input.includes("price") || input.includes("cost")) {
        return "You can see the full price by clicking on any product.";
    }

    if (input.includes("recommend") || input.includes("suggest")) {
        return "Sure! Here are some products you may like!";
    }

    if (input.includes("find") || input.includes("search")) {
        return "You can search products using the search bar. What category you need?";
    }

    if (input.includes("help") || input.includes("support")) {
        return "I'm here to help! Ask anything about products or prices.";
    }

    if (input.includes("thanks") || input.includes("thank you")) {
        return "You're welcome! 😊";
    }

    return "Sorry, I didn't understand that. Try asking about price or help.";
}