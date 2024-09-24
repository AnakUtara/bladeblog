import DOMPurify from "dompurify";

export default class Chat {
    constructor() {
        this.openedYet = false;
        this.chatWrapper = document.querySelector("#chat-wrapper");
        this.avatar = document.querySelector("#chat-wrapper").dataset.avatar;
        this.openIcon = document.querySelector(".header-chat-icon");
        this.injectHTML();
        this.chatLog = document.querySelector("#chat");
        this.chatField = document.querySelector("#chatField");
        this.chatForm = document.querySelector("#chatForm");
        this.closeIcon = document.querySelector(".chat-title-bar-close");
        this.events();
    }

    // Events
    events() {
        this.chatForm.addEventListener("submit", (e) => {
            e.preventDefault();
            this.sendMessageToServer();
        });
        this.openIcon.addEventListener("click", () => this.showChat());
        this.closeIcon.addEventListener("click", () => this.hideChat());
    }

    // Methods
    sendMessageToServer() {
        const test = document.createElement("div");
        test.innerHTML = DOMPurify.sanitize(this.chatField.value);

        axios.post(
            "/send-chat",
            { message: this.chatField.value },
            {
                headers: {
                    "X-Socket-ID": Echo.socketId(),
                },
            }
        );

        this.chatLog.insertAdjacentHTML(
            "beforeend",
            DOMPurify.sanitize(`
    <div class="chat-self">
        <div class="chat-message">
            <div class="chat-message-inner">
                ${test.textContent}
            </div>
        </div>
        <img class="chat-avatar avatar-tiny" src="${this.avatar}">
    </div>
    `)
        );
        this.chatLog.scrollTop = this.chatLog.scrollHeight;
        this.chatField.value = "";
        this.chatField.focus();
    }

    hideChat() {
        this.chatWrapper.classList.remove("chat--visible");
    }

    showChat() {
        if (!this.openedYet) {
            this.openConnection();
        }
        this.openedYet = true;
        this.chatWrapper.classList.add("chat--visible");
        this.chatField.focus();
    }

    openConnection() {
        Echo.private("chat-channel").listen("ChatMessage", (e) => {
            console.log(e.chat);
            this.displayMessageFromServer(e.chat);
        });
    }

    displayMessageFromServer(data) {
        this.chatLog.insertAdjacentHTML(
            "beforeend",
            DOMPurify.sanitize(`
    <div class="chat-other">
        <a href="/profile/${data.username}"><img class="avatar-tiny" src="${data.avatar}"></a>
        <div class="chat-message"><div class="chat-message-inner">
            <a href="/profile/${data.username}"><strong>${data.username}:</strong></a>
            ${data.message}
        </div></div>
    </div>
    `)
        );
        this.chatLog.scrollTop = this.chatLog.scrollHeight;
    }

    injectHTML() {
        this.chatWrapper.classList.add("chat-wrapper--ready");
        this.chatWrapper.innerHTML = `
    <div class="chat-title-bar">Chat
        <span class="chat-title-bar-close size-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
        </span>
    </div>
    <div id="chat" class="chat-log"></div>

    <form id="chatForm" class="chat-form border-top">
        <input type="text" class="chat-field" id="chatField" placeholder="Type a message…" autocomplete="off">
    </form>
    `;
    }
}
