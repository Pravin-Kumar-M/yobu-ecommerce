<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* button */
        #chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: black;
            /* WhatsApp */
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        /* window */
        #chatbot-window {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 300px;
            height: 400px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            overflow: hidden;
            font-family: Arial, sans-serif;
            z-index: 1000;
        }

        .chat-header {
            background: black;
            color: white;
            padding: 12px;
            font-weight: bold;
            text-align: center;
        }

        .chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            font-size: 14px;
        }

        .bot-message,
        .user-message {
            margin: 8px 0;
            padding: 10px;
            border-radius: 8px;
            max-width: 80%;
        }

        .bot-message {
            background: #f1f1f1;
            align-self: flex-start;
        }

        .user-message {
            background: #25d366;
            color: white;
            align-self: flex-end;
        }

        .chat-footer {
            display: flex;
            border-top: 1px solid #ddd;
        }

        #chat-input {
            flex: 1;
            padding: 10px;
            border: none;
            outline: none;
        }

        #send-btn {
            background: black;
            border: none;
            color: white;
            padding: 0 15px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>



    @include ('Home.home_header')

    @include('Home.home_hero_banner')

    @include ('Home.home_product')

    @include('Home.home_blog_sections')


    <!-- Floating Chat Button -->
    <div id="chatbot-button">
        <i class="bi bi-robot"></i>
    </div>

    <!-- Chat Window -->
    <div id="chatbot-window">
        <div class="chat-header">Support</div>
        <div class="chat-body" id="chat-body">
            <div class="bot-message">👋 Hi! How can I help you today?</div>
        </div>
        <div class="chat-footer">
            <input type="text" id="chat-input" placeholder="Type a message...">
            <button id="send-btn">➤</button>
        </div>
    </div>

    @include ('Home.home_footer')

    <script>
        let chatMode = "bot"; // default: bot answers first

        // Toggle chat window
        document.getElementById("chatbot-button").addEventListener("click", function() {
            let chatWindow = document.getElementById("chatbot-window");
            chatWindow.style.display = (chatWindow.style.display === "flex") ? "none" : "flex";
            if (chatWindow.style.display === "flex") {
                loadMessages(); // load only if admin mode
            }
        });

        // Send message
        document.getElementById("send-btn").addEventListener("click", sendMessage);
        document.getElementById("chat-input").addEventListener("keypress", function(e) {
            if (e.key === "Enter") sendMessage();
        });

        function sendMessage() {
            let input = document.getElementById("chat-input");
            let message = input.value.trim();
            if (message === "") return;

            let chatBody = document.getElementById("chat-body");

            // Show user msg immediately
            let userMsg = document.createElement("div");
            userMsg.classList.add("user-message");
            userMsg.textContent = message;
            chatBody.appendChild(userMsg);
            chatBody.scrollTop = chatBody.scrollHeight;
            input.value = "";

            if (chatMode === "bot") {
                handleBotReply(message);
            } else {
                sendToAdmin(message);
            }
        }

        // Bot Reply Logic
        function handleBotReply(message) {
            let lower = message.toLowerCase();
            let chatBody = document.getElementById("chat-body");
            let botMsg = document.createElement("div");
            botMsg.classList.add("bot-message");

            if (lower.includes("hi") || lower.includes("hello")) {
                botMsg.textContent = "Hello 👋 What can I help you with?";
            } else if (lower.includes("order")) {
                botMsg.textContent = "📦 You can track your order in 'My Orders'.";
            } else if (lower.includes("refund")) {
                botMsg.textContent = "💸 Refunds are processed within 5-7 days.";
            } else if (lower.includes("payment")) {
                botMsg.textContent = "💳 We support multiple payment methods including Credit/Debit Cards, UPI, and Wallets.";
            } else if (lower.includes("customize")) {
                botMsg.textContent = "🎨 Yes! You can customize your products using our product customizer before checkout.";
            } else if (lower.includes("support") || lower.includes("admin") || lower.includes("help")) {
                botMsg.textContent = "⏳ Connecting you with an admin...";
                chatMode = "admin"; // switch to admin mode

                // Now future messages go to DB
                setTimeout(() => {
                    sendToAdmin(message);
                    loadMessages();
                }, 1000);
            } else {
                botMsg.textContent = "🤔 I'm not sure about that. Connecting you with an admin...";
                chatMode = "admin"; // switch to admin
                setTimeout(() => {
                    sendToAdmin(message);
                    loadMessages();
                }, 1000);
            }

            chatBody.appendChild(botMsg);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        // 📤 Send to DB (Admin mode)
        function sendToAdmin(message) {
            fetch("{{ url('/chat/messages') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    message: message
                })
            }).then(() => {
                loadMessages();
            });
        }

        // 📥 Load messages (user + admin)
        function loadMessages() {
            if (chatMode === "bot") return; // don't load DB msgs until admin mode

            fetch("{{ url('/chat/messages') }}")
                .then(res => res.json())
                .then(messages => {
                    let chatBody = document.getElementById("chat-body");
                    chatBody.innerHTML = "";

                    messages.forEach(msg => {
                        let div = document.createElement("div");
                        if (msg.sender === "user") {
                            div.classList.add("user-message");
                        } else {
                            div.classList.add("bot-message"); // admin reply
                        }
                        div.textContent = msg.message;
                        chatBody.appendChild(div);
                    });

                    chatBody.scrollTop = chatBody.scrollHeight;
                });
        }

        // Polling for admin replies
        setInterval(loadMessages, 5000);
    </script>


</body>

</html>