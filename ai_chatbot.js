function sendMessage(event){
    if(event.key === "Enter"){
        let input = document.getElementById("userInput").value;
        let chat = document.getElementById("chat-area");
        
        chat.innerHTML += `<p><b>You:</b> ${input}</p>`;
        
        let reply = "";

        if(input.includes("price")) reply = "Please click on the product to see full details.";
        else if(input.includes("hello")) reply = "Hello! How can I help you today?";
        else if(input.includes("recommend")) reply = "Sure! Check out our top AI recommended products.";
        else reply = "Sorry, I didn't understand that. Try asking about price, products, or recommendations.";

        chat.innerHTML += `<p><b>AI:</b> ${reply}</p>`;
        document.getElementById("userInput").value = "";
    }
}