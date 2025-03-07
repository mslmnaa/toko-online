// resources/js/app.js

import './bootstrap';

// Import Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Import libraries yang dibutuhkan
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// Membuat objek global untuk Leaflet
window.L = L;

// Event listener untuk map initialization
document.addEventListener("DOMContentLoaded", function () {
    // Cek apakah element map ada
    const mapElement = document.getElementById('map');
    if (mapElement) {
        // Inisialisasi peta
        const map = L.map('map').setView([-7.768111563215865, 110.33369069486987], 13); // Koordinat Jakarta

        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan marker
        L.marker([-7.768111563215865, 110.33369069486987])
            .addTo(map)
            .bindPopup('Our Location')
            .openPopup();
    }
});

// Toast notification handler
window.showToast = (message, type = 'success') => {
    // Implementation untuk toast notifications
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 right-4 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out animate-slide-in-right`;
    toast.innerHTML = `
        <div class="flex items-center space-x-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <p>${message}</p>
        </div>
    `;
    document.body.appendChild(toast);

    // Hapus toast setelah 5 detik
    setTimeout(() => {
        toast.remove();
    }, 5000);
};

// Form validation handler
const contactForm = document.querySelector('form');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const messageInput = document.getElementById('message');
        
        let isValid = true;
        
        // Basic validation
        if (!nameInput.value.trim()) {
            isValid = false;
            nameInput.classList.add('border-red-500');
        }
        
        if (!emailInput.value.trim() || !emailInput.value.includes('@')) {
            isValid = false;
            emailInput.classList.add('border-red-500');
        }
        
        if (!messageInput.value.trim()) {
            isValid = false;
            messageInput.classList.add('border-red-500');
        }
        
        if (!isValid) {
            e.preventDefault();
            showToast('Please fill all required fields correctly', 'error');
        }
    });
}

// Animation handler
const animateOnScroll = () => {
    const elements = document.querySelectorAll('.animate-on-scroll');
    
    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const elementVisible = 150;
        
        if (elementTop < window.innerHeight - elementVisible) {
            element.classList.add('visible');
        }
    });
};

window.addEventListener('scroll', animateOnScroll);