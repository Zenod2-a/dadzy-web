/**
 * DAdzy Website - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Create Stars Background
    function createStars() {
        const cosmicBg = document.getElementById('cosmicBg');
        if (!cosmicBg) return;
        
        for (let i = 0; i < 150; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            star.style.left = Math.random() * 100 + '%';
            star.style.top = Math.random() * 100 + '%';
            const sizes = ['1px', '1.5px', '2px', '2.5px', '3px'];
            star.style.width = sizes[Math.floor(Math.random() * sizes.length)];
            star.style.height = star.style.width;
            star.style.animationDuration = (2 + Math.random() * 4) + 's';
            star.style.animationDelay = Math.random() * 4 + 's';
            cosmicBg.appendChild(star);
        }
    }
    createStars();
    
    // Header Scroll Effect
    const header = document.getElementById('header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // Mobile Menu
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            const icon = mobileMenuBtn.querySelector('i');
            if (mobileMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
        
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                mobileMenuBtn.querySelector('i').classList.remove('fa-times');
                mobileMenuBtn.querySelector('i').classList.add('fa-bars');
            });
        });
    }
    
    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 80;
                const position = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: position, behavior: 'smooth' });
            }
        });
    });
    
    // Rating Stars for Feedback Form
    let selectedRating = 0;
    const ratingButtons = document.querySelectorAll('.rating-stars button');
    
    ratingButtons.forEach((btn) => {
        btn.addEventListener('click', function() {
            selectedRating = parseInt(this.dataset.rating);
            updateRatingStars();
            document.getElementById('rating').value = selectedRating;
        });
        
        btn.addEventListener('mouseenter', function() {
            highlightStars(parseInt(this.dataset.rating));
        });
        
        btn.addEventListener('mouseleave', function() {
            updateRatingStars();
        });
    });
    
    function highlightStars(count) {
        ratingButtons.forEach((btn, index) => {
            const icon = btn.querySelector('i');
            if (index < count) {
                icon.classList.add('active');
            } else {
                icon.classList.remove('active');
            }
        });
    }
    
    function updateRatingStars() {
        highlightStars(selectedRating);
    }
    
    // Contact Form Handler
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(contactForm);
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            fetch('api/contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    contactForm.reset();
                } else {
                    showAlert('error', data.message || 'An error occurred');
                }
            })
            .catch(error => {
                console.error('Contact form error:', error);
                showAlert('error', 'Connection error. Please try again.');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // Feedback Form Handler
    const feedbackForm = document.getElementById('feedbackForm');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(feedbackForm);
            formData.set('rating', selectedRating);
            
            const submitBtn = feedbackForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            fetch('api/feedback.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    feedbackForm.reset();
                    selectedRating = 0;
                    updateRatingStars();
                } else {
                    showAlert('error', data.message || 'An error occurred');
                }
            })
            .catch(error => {
                console.error('Feedback form error:', error);
                showAlert('error', 'Connection error. Please try again.');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // Alert Popup Function
    function showAlert(type, message) {
        const existing = document.querySelector('.alert-popup');
        if (existing) existing.remove();
        
        const alert = document.createElement('div');
        alert.className = 'alert-popup alert-' + type;
        alert.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
        `;
        alert.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            padding: 1rem 1.5rem;
            background: ${type === 'success' ? 'rgba(34,197,94,0.1)' : 'rgba(239,68,68,0.1)'};
            border: 1px solid ${type === 'success' ? 'rgba(34,197,94,0.3)' : 'rgba(239,68,68,0.3)'};
            border-radius: 0.5rem;
            color: ${type === 'success' ? '#22c55e' : '#ef4444'};
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 10000;
            animation: slideIn 0.3s ease;
        `;
        
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }, 4000);
    }
    
    // Add animation styles
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
});

// ============================================
// AI CHATBOX CLASS
// ============================================
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
                            <div class="message-content">Hello! Welcome to DAdzy! 👋 I'm your AI assistant. How can I help you today?</div>
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

// Initialize Chatbox on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    window.dadzyChat = new DAdzyChat();
});
