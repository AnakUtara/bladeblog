import "./bootstrap";
import "flowbite";

import Alpine from "alpinejs";

const baseURL = import.meta.env.VITE_BASE_URL;

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
