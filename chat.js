/**
 * DAdzy - AI Chatbox Frontend
 * Connects to OpenAI via PHP backend
 */

class DAdzyChat {
    constructor() {
        this.apiUrl = 'api/chat.php';
        this.sessionId = this.getSessionId();
        this.isOpen = false;
        this.init();
    }

    getSessionId() {
        let sessionId = localStorage.getItem('dadzy_chat_session');
        if (!sessionId) {
            sessionId = 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('dadzy_chat_session', sessionId);
        }
        return sessionId;
    }

    init() {
        this.createChatbox();
        this.bindEvents();
        console.log('🤖 DAdzy Chat initialized. Session:', this.sessionId);
    }

    createChatbox() {
        const chatboxHTML = `
            <div class="chatbox-container">
                <div class="chatbox-window" id="chatboxWindow">
                    <div class="chatbox-header">
                        <div class="chatbox-avatar">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="chatbox-info">
                            <h4>DAdzy AI Assistant</h4>
                            <span class="status-indicator">Online</span>
                        </div>
                        <button class="chatbox-close" id="chatboxClose">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="chatbox-messages" id="chatboxMessages">
                        <div class="chat-message bot">
                            <div class="message-avatar"><i class="fas fa-robot"></i></div>
                            <div class="message-content">Hello! Welcome to DAdzy! I'm your AI assistant. How can I help you today?</div>
                        </div>
                    </div>
                    <div class="quick-actions">
                        <button class="quick-action" data-message="What services do you offer?">Services</button>
                        <button class="quick-action" data-message="Tell me about your team">Team</button>
                        <button class="quick-action" data-message="How can I contact you?">Contact</button>
                        <button class="quick-action" data-message="What is your pricing?">Pricing</button>
                    </div>
                    <div class="chatbox-input">
                        <input type="text" id="chatInput" placeholder="Type your message..." autocomplete="off">
                        <button id="chatSendBtn"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
                <button class="chatbox-toggle" id="chatboxToggle">
                    <i class="fas fa-comment-dots"></i>
                </button>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', chatboxHTML);
    }

    bindEvents() {
        // Toggle chatbox
        document.getElementById('chatboxToggle').addEventListener('click', () => this.toggle());
        document.getElementById('chatboxClose').addEventListener('click', () => this.close());

        // Send message
        document.getElementById('chatSendBtn').addEventListener('click', () => this.sendMessage());
        document.getElementById('chatInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.sendMessage();
        });

        // Quick actions
        document.querySelectorAll('.quick-action').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('chatInput').value = btn.dataset.message;
                this.sendMessage();
            });
        });
    }

    toggle() {
        this.isOpen ? this.close() : this.open();
    }

    open() {
        document.getElementById('chatboxWindow').classList.add('open');
        document.getElementById('chatboxToggle').classList.add('active');
        this.isOpen = true;
        document.getElementById('chatInput').focus();
    }

    close() {
        document.getElementById('chatboxWindow').classList.remove('open');
        document.getElementById('chatboxToggle').classList.remove('active');
        this.isOpen = false;
    }

    async sendMessage() {
        const input = document.getElementById('chatInput');
        const message = input.value.trim();

        if (!message) return;

        // Clear input and show user message
        input.value = '';
        this.addMessage(message, 'user');

        // Show typing indicator
        this.showTyping();

        try {
            console.log('📤 Sending message:', message);

            const response = await fetch(this.apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    message: message,
                    session_id: this.sessionId
                })
            });

            console.log('📥 Response status:', response.status);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log('📥 Response data:', data);

            this.hideTyping();

            if (data.reply) {
                this.addMessage(data.reply, 'bot');
            } else if (data.error) {
                this.addMessage(`Error: ${data.error}`, 'bot');
            } else {
                this.addMessage('Sorry, I received an unexpected response. Please try again.', 'bot');
            }

        } catch (error) {
            console.error('❌ Chat error:', error);
            this.hideTyping();
            this.addMessage('Sorry, I couldn\'t connect. Please check your connection and try again.', 'bot');
        }
    }

    addMessage(text, type) {
        const container = document.getElementById('chatboxMessages');
        const avatar = type === 'bot' 
            ? '<i class="fas fa-robot"></i>' 
            : '<i class="fas fa-user"></i>';

        const messageHTML = `
            <div class="chat-message ${type}">
                <div class="message-avatar">${avatar}</div>
                <div class="message-content">${this.escapeHtml(text).replace(/\n/g, '<br>')}</div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', messageHTML);
        container.scrollTop = container.scrollHeight;
    }

    showTyping() {
        const container = document.getElementById('chatboxMessages');
        const typingHTML = `
            <div class="chat-message bot typing-message">
                <div class="message-avatar"><i class="fas fa-robot"></i></div>
                <div class="typing-indicator">
                    <span></span><span></span><span></span>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', typingHTML);
        container.scrollTop = container.scrollHeight;
    }

    hideTyping() {
        const typing = document.querySelector('.typing-message');
        if (typing) typing.remove();
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    window.dadzyChat = new DAdzyChat();
});
