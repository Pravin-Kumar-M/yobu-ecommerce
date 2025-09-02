<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
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
            z-index: 5000;
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

        .floating-actions {
            position: fixed;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 1050;
        }

        .fab {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border: 0;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .18);
            transition: transform .18s ease, box-shadow .18s ease, opacity .18s ease;
        }

        .fab:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .22);
        }

        .fab:active {
            transform: translateY(0);
        }

        .fab-whatsapp {
            background: #25D366;
        }

        .fab-form {
            background: #0d6efd;
        }

        .fab-mail {
            background: #ea4335;
        }

        /* Slide-in contact panel */
        .contact-panel {
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 360px;
            max-width: 92vw;
            background: #fff;
            box-shadow: -10px 0 30px rgba(0, 0, 0, .12);
            transform: translateX(100%);
            transition: transform .28s ease;
            z-index: 1100;
            display: flex;
            flex-direction: column;
            border-left: 1px solid rgba(0, 0, 0, .06);
        }

        .contact-panel.open {
            transform: translateX(0);
        }

        .cp-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-bottom: 1px solid rgba(0, 0, 0, .08);
            font-size: 16px;
        }

        .cp-close {
            background: transparent;
            border: 0;
            font-size: 24px;
            line-height: 1;
            cursor: pointer;
        }

        .cp-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .cp-field label {
            font-size: 12px;
            color: #555;
            margin-bottom: 4px;
            display: block;
        }

        .cp-input {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 12px;
            outline: none;
            transition: border-color .18s ease, box-shadow .18s ease;
        }

        .cp-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .15);
        }

        .cp-submit {
            background: #0d6efd;
            color: #fff;
            border: 0;
            border-radius: 12px;
            padding: 10px 14px;
            cursor: pointer;
        }

        /* 🔥 Responsive tweaks */
        @media (max-width: 768px) {

            /* chatbot shrinks */
            #chatbot-button {
                width: 48px;
                height: 48px;
                font-size: 22px;
                bottom: 15px;
                right: 15px;
            }

            #chatbot-window {
                width: 260px;
                height: 340px;
                bottom: 70px;
                right: 12px;
            }

            /* icons shrink + move above chatbot */
            .floating-actions {
                right: 12px;
                bottom: 120px;
                /* stack above chatbot */
                top: auto;
                transform: none;
                flex-direction: column;
                /* horizontal row */
                gap: 8px;
            }

            .fab {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 480px) {
            #chatbot-window {
                width: 92%;
                /* take most of screen */
                right: 4%;
                height: 300px;
            }
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2392.881370624239!2d-9.0046555!3d53.2729435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x485b96c299d510d7%3A0x1234567890abcdef!2s129%20Ti%20Niel%2C%20Gleann%20Na%20Ri%2C%20Murrough%2C%20Galway%2C%20Ireland%2C%20H91P582!5e0!3m2!1sen!2sie!4v1692094512345!5m2!1sen!2sie"
            width="100%"
            height="500"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>Ireland</h4>
                                <p>129, Ti Niel, Gleann Na Ri, Murrough, Galway,Ireland, H91P582 </p>
                            </li>
                            <li>
                                <h4>India </h4>
                                <p>12/266 F,WATERTANK STREET
                                    PULAVANPATTI,SIVANTHIPURAM,AMBASAMUDRAM, Tirunelveli, Tamilnadu, India 627425</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message"></textarea>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- forms -->
    <!-- ===== Floating Actions (Right Sticky) ===== -->
    <div class="floating-actions" aria-label="Quick actions">
        <!-- WhatsApp -->
        <a
            class="fab fab-whatsapp"
            href="https://wa.me/917695836103?text=Hi%20Team%2C%20I%20need%20help"
            target="_blank" rel="noopener"
            title="Chat on WhatsApp" aria-label="Chat on WhatsApp">
            <!-- WhatsApp SVG -->
            <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                <path fill="currentColor" d="M20.52 3.48A11.91 11.91 0 0 0 12.07.5 11.53 11.53 0 0 0 .5 12.03 11.37 11.37 0 0 0 2.9 18.5L2 23l4.6-1.2a11.63 11.63 0 0 0 5.47 1.39h.01c6.34 0 11.5-5.16 11.51-11.5a11.45 11.45 0 0 0-3.07-8.21Zm-8.45 19.02h-.01a9.7 9.7 0 0 1-4.94-1.35l-.35-.2-2.72.72.73-2.65-.23-.37a9.64 9.64 0 1 1 18.16-4.81 9.67 9.67 0 0 1-9.64 9.66Zm5.31-7.26c-.29-.15-1.7-.84-1.96-.93-.26-.1-.45-.15-.65.15-.19.29-.75.93-.92 1.12-.17.2-.34.22-.63.08-.29-.15-1.23-.45-2.34-1.44-.86-.77-1.44-1.72-1.6-2.01-.17-.29-.02-.45.13-.6.14-.14.29-.34.44-.51.14-.17.19-.29.29-.49.1-.2.05-.37-.02-.52-.07-.15-.65-1.56-.89-2.13-.24-.57-.48-.49-.65-.49l-.55-.01c-.2 0-.51.07-.78.37-.26.29-1.02 1-1.02 2.43 0 1.43 1.04 2.81 1.19 3.01.15.2 2.05 3.13 4.98 4.39.7.3 1.25.48 1.68.61.7.22 1.34.19 1.84.12.56-.08 1.7-.7 1.94-1.38.24-.68.24-1.26.17-1.38-.07-.12-.26-.2-.55-.35Z" />
            </svg>
        </a>

        <!-- Contact Form (opens panel) -->
        <button class="fab fab-form" id="openContact" title="Open contact form" aria-label="Open contact form">
            <!-- Form (pencil) SVG -->
            <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25Zm18-11.5a1 1 0 0 0 0-1.41L19.66 2a1 1 0 0 0-1.41 0L16 4.25l3.75 3.75L21 5.75Z" />
            </svg>
        </button>

        <!-- Mail -->
        <a
            class="fab fab-mail"
            href="mailto:support@yoursite.com?subject=Support%20Request"
            title="Send Email" aria-label="Send Email">
            <!-- Mail SVG -->
            <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                <path fill="currentColor" d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4-8 5L4 8V6l8 5 8-5v2Z" />
            </svg>
        </a>
    </div>

    <!-- ===== Slide-in Contact Panel ===== -->
    <div class="contact-panel" id="contactPanel" aria-hidden="true">
        <div class="cp-header">
            <strong>Contact Us</strong>
            <button class="cp-close" id="closeContact" aria-label="Close contact form">&times;</button>
        </div>
        <form id="contactForm" class="cp-body">
            <!-- If using Blade, uncomment the next line -->
            <!-- @csrf -->
            <div class="cp-field">
                <label for="cpName">Name</label>
                <input id="cpName" name="name" type="text" class="cp-input" required>
            </div>
            <div class="cp-field">
                <label for="cpEmail">Email</label>
                <input id="cpEmail" name="email" type="email" class="cp-input" required>
            </div>
            <div class="cp-field">
                <label for="cpMsg">Message</label>
                <textarea id="cpMsg" name="message" rows="4" class="cp-input" required></textarea>
            </div>
            <button type="submit" class="cp-submit">Send</button>
        </form>
    </div>

    <!-- chat button -->

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

    <!-- ===== Script (toggle + optional submit) ===== -->
    <script>
        (function() {
            const panel = document.getElementById('contactPanel');
            const openBtn = document.getElementById('openContact');
            const closeBtn = document.getElementById('closeContact');

            function openPanel() {
                panel.classList.add('open');
                panel.setAttribute('aria-hidden', 'false');
                // focus first field
                const first = panel.querySelector('.cp-input');
                if (first) setTimeout(() => first.focus(), 120);
            }

            function closePanel() {
                panel.classList.remove('open');
                panel.setAttribute('aria-hidden', 'true');
            }

            openBtn.addEventListener('click', openPanel);
            closeBtn.addEventListener('click', closePanel);
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') closePanel();
            });
            document.addEventListener('click', e => {
                if (panel.classList.contains('open')) {
                    const within = panel.contains(e.target) || openBtn.contains(e.target);
                    if (!within) closePanel();
                }
            });

            // Optional: handle form submit (AJAX). Wire to your route.
            document.getElementById('contactForm').addEventListener('submit', async function(e) {
                e.preventDefault();



                const formData = new FormData(this);

                // Demo: show success and close; replace with actual fetch to your backend.
                // await fetch(url, { method:'POST', headers:{ 'X-CSRF-TOKEN': csrf }, body: formData });

                alert('Thanks! We will get back to you soon.');
                closePanel();
                this.reset();
            });
        })();

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
            } else if (lower.includes("support") || lower.includes("admin") || lower.includes("help")) {
                botMsg.textContent = "⏳ Connecting you with an admin...";
                chatMode = "admin";

                setTimeout(() => {
                    sendToAdmin(message);
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
                    message
                })
            });
        }

        // 📥 Load messages (user + admin)
        let lastId = 0;

        function loadMessages() {
            if (chatMode === "bot") return;

            fetch(`/chat/messages?last_id=${lastId}`)
                .then(res => res.json())
                .then(messages => {
                    if (messages.length > 0) {
                        let chatBody = document.getElementById("chat-body");
                        messages.forEach(msg => {
                            let div = document.createElement("div");
                            div.classList.add(msg.sender === "user" ? "user-message" : "bot-message");
                            div.textContent = msg.message;
                            chatBody.appendChild(div);
                            lastId = msg.id; // update last seen
                        });
                        chatBody.scrollTop = chatBody.scrollHeight;
                    }
                });
        }


        // Polling for admin replies
        setInterval(loadMessages, 5000);
    </script>

</body>

</html>