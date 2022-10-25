import { Notyf } from 'notyf';
const notyf = new Notyf({ duration: 2000 });

// notification

Livewire.on("error", (message) => {
    notyf.error(message);
});

Livewire.on("success", (message) => {
    notyf.success(message);
});

