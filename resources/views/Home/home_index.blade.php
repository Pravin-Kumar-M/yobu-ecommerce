<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
        💬
    </div>

    <style>
        #chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25d366;
            /* WhatsApp green */
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
        }
    </style>

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

    <style>
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
        }

        .chat-header {
            background: #25d366;
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
            background: #25d366;
            border: none;
            color: white;
            padding: 0 15px;
            cursor: pointer;
        }
    </style>

    @include ('Home.home_footer')

    <script>
        const faq = {
            "order": "📦 You can track your order in your account → My Orders.",
            "refund": "💸 Refunds are processed within 5–7 business days.",
            "shipping": "🚚 Free shipping on orders above $50.",
            "payment": "💳 We accept Credit/Debit Cards, PayPal, and COD."
        };

        document.getElementById("chatbot-button").addEventListener("click", function() {
            let chatWindow = document.getElementById("chatbot-window");
            chatWindow.style.display = (chatWindow.style.display === "flex") ? "none" : "flex";
        });

        document.getElementById("send-btn").addEventListener("click", sendMessage);
        document.getElementById("chat-input").addEventListener("keypress", function(e) {
            if (e.key === "Enter") sendMessage();
        });

        function sendMessage() {
            let input = document.getElementById("chat-input");
            let message = input.value.trim();
            if (message === "") return;

            let chatBody = document.getElementById("chat-body");

            // Show user message
            let userMsg = document.createElement("div");
            userMsg.classList.add("user-message");
            userMsg.textContent = message;
            chatBody.appendChild(userMsg);

            // Bot reply
            setTimeout(() => {
                let reply = getBotReply(message);

                let botMsg = document.createElement("div");
                botMsg.classList.add("bot-message");
                botMsg.innerHTML = reply;
                chatBody.appendChild(botMsg);

                chatBody.scrollTop = chatBody.scrollHeight;
            }, 800);

            input.value = "";
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function getBotReply(message) {
            message = message.toLowerCase();

            // Search in FAQs
            for (let key in faq) {
                if (message.includes(key)) {
                    return faq[key];
                }
            }

            // Escalation option
            return `🤔 I’m not sure about that.<br>
                <button onclick="escalateToAgent()" 
                    style="margin-top:6px; padding:6px 10px; background:#25d366; color:white; border:none; border-radius:6px; cursor:pointer;">
                    Talk to Support Agent
                </button>`;
        }

        function escalateToAgent() {
            let chatBody = document.getElementById("chat-body");
            let botMsg = document.createElement("div");
            botMsg.classList.add("bot-message");
            botMsg.textContent = "A support agent will join shortly...";
            chatBody.appendChild(botMsg);
            chatBody.scrollTop = chatBody.scrollHeight;

            // 🔗 Later: Connect this to Laravel Live Chat API
        }
    </script>


</body>

</html>