import "./bootstrap";
import "flowbite";
import Chat from "./chat";
import Alpine from "alpinejs";

const baseURL = import.meta.env.VITE_BASE_URL;

if (document.querySelector(".header-chat-icon")) {
    new Chat();
}

window.liveSearch = async (search) => {
    if (search) {
        const res = await axios.get(`${baseURL}/search`, {
            params: { search },
        });
        return res.data;
    }
};

window.Alpine = Alpine;

Alpine.start();
